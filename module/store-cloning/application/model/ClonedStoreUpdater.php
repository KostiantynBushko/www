<?php

// UPDATE Manufacturer SET defaultImageID=(SELECT ID FROM ManufacturerImage WHERE manufacturerID=Manufacturer.ID AND position=0 LIMIT 1)

/**
 *
 * todo:
 * import in remote server (file transfer API + init import),
 * fetch images from child stores,
 * sync activation gui,
 * display errors in gui
 *
 */

class ClonedStoreUpdater
{
	private $application;

	private $database;

	private $importDatabase;

	private static $ignoredTables = array(
		'AccessControlAssociation', 'ProductNotification', 'BackendToolbarItem', 'BillingAddress', 
		'CategoryImage', 
		'ClonedStoreRule', 'ClonedStore', 'ClonedStoreCategory', 'CustomerOrder', 'ExpressCheckout', 
		'HelpComment', 'NewsletterMessage', 'NewsletterSentMessage', 'NewsletterSubscriber', 
		'NewsPost', 'OrderCoupon', 'OrderDiscount', 'OrderedFile', 'OrderedItem', 'OrderedItemOption', 
		'OrderLog', 'OrderNote', 'ProductReview', 'RecurringProductPeriod', 'Role', 'SearchableItem', 
		'SearchLog', 'State', 'StaticPage', 'Shipment', 'ShipmentTax', 'ShippingAddress', 
		'Transaction', 'User', 'UserAddress', 'UserGroup', 'SessionData', 'Currency',
		'DeliveryZone', 'DeliveryZoneAddressMask', 'DeliveryZoneCityMask', 'DeliveryZoneCountry',
		'DeliveryZoneRealTimeService', 'DeliveryZoneState', 'DeliveryZoneZipMask', 'Discount',
		'DiscountAction', 'DiscountCondition', 'DiscountConditionRecord', 'EavDateValue', 'EavField',
		'EavFieldGroup', 'EavItem', 'EavNumericValue', 'EavObject', 'EavStringValue', 'EavValue',
		'ShippingClass', 'ShippingRate', 'ShippingService', 'Tax', 'TaxClass', 'TaxRate');

	private $tables = array();

	private $ids = array();

	private $timestamp;

	private $dbLogin;

	private $errors = array();
	
	private $isOverride;

	public function __construct(LiveCart $application, $database)
	{
ini_set('memory_limit', '1700M');
set_time_limit(0);

error_reporting(E_ALL);
ini_set('display_errors', 'On');

		Category::reindex();
		Category::recalculateProductsCount();
$this->flush(__line__);
		$this->application = $application;
		$this->database = $database;
		$this->dbLogin = $this->getDBLogin();
		$this->importDatabase = $database . '_import';
$this->flush(__line__);
		$this->timestamp = new ARSerializableDateTime(array_pop(array_pop(ActiveRecordModel::getDataBySQL('SELECT NOW()'))));
		$this->createSnapshot();
$this->flush(__line__);
		foreach (ActiveRecordModel::getDataBySQL('SHOW TABLES IN ' . $database) as $table)
		{
			$table = array_shift($table);
			if (!in_array($table, self::$ignoredTables))
			{
				$this->tables[] = $table;
			}
		}
$this->flush(__line__);
	}

	public function syncAll($select = null)
	{
		$this->errors = array();
$this->flush(__line__);
		// find deleted records
		$file = $this->getIDFile();
		$previousIDs = file_exists($file) ? include $file : array();
		$deleted = $this->getDeletedRecordIDs($previousIDs);
$this->flush(__line__);

		// get previous timestamp
		$file = $this->getTimestampFile();
		$timestamp = null;
		//$timestamp = file_exists($file) ? include $file : null;
$this->flush(__line__);
		// get files
		$files = $this->getFileList();
$this->flush(__line__);
		// update each store
		$select = !empty($select) ? $select : select();
		foreach (ActiveRecordModel::getRecordSet('ClonedStore', $select) as $store)
		{
$this->flush(__line__);
			$this->updateStore($store, $deleted, $files);
		}

		file_put_contents($this->getIDFile(), '<?php return ' . var_export($this->getRecordIDs(), true) . ';', LOCK_EX);
		file_put_contents($this->getTimestampFile(), '<?php return ' . var_export($this->getTimestamp(), true) . ';', LOCK_EX);
	}

	public function getRecordIDs()
	{
		if (!$this->ids)
		{
			$this->ids = array();
			foreach ($this->tables as $table)
			{
				try
				{
					foreach (ActiveRecordModel::getDataBySQL('SELECT ID FROM ' . $this->database . '.' . $table) as $id)
					{
						$this->ids[$table][] = array_pop($id);
					}
				}
				catch (Exception $e)
				{

				}
			}
		}

		return $this->ids;
	}

	public function getTimestamp()
	{
		return $this->timestamp;
	}

	public function getDeletedRecordIDs($previousSnapshotIDs)
	{
		$deleted = array();
		$current = $this->getRecordIDs();

		foreach ($previousSnapshotIDs as $table => $ids)
		{
			$c = isset($current[$table]) ? $current[$table] : array();
			$deleted[$table] = array_diff($ids, $c);
		}

		return $deleted;
	}

	public function removeUnsyncableDataFromSnapshot()
	{
		ActiveRecordModel::executeUpdate('SET FOREIGN_KEY_CHECKS=0');

		foreach (self::$ignoredTables as $table)
		{
			try
			{
				ActiveRecordModel::executeUpdate('DROP TABLE ' . $this->importDatabase . '.' . $table);
			}
			catch (Exception $e)
			{}
		}

		ActiveRecordModel::executeUpdate('ALTER TABLE ' . $this->importDatabase . '.Product DROP COLUMN `rating`, DROP COLUMN `ratingSum`, DROP COLUMN `ratingCount`, DROP COLUMN `hits`, DROP COLUMN `reviewCount`');

		ActiveRecordModel::executeUpdate('SET FOREIGN_KEY_CHECKS=1');
	}

	public function removeUnchangedDataFromSnapshot($timestamp)
	{
		if (!$timestamp)
		{
			return;
		}

		// changes in category selection, needs full update
		if (ActiveRecordModel::getRecordCount('ClonedStoreCategory', select(gte(f('ClonedStoreCategory.lastModifiedTime'), $timestamp))))
		{
			return;
		}

		ActiveRecordModel::executeUpdate('SET FOREIGN_KEY_CHECKS=0');

		foreach ($this->tables as $table)
		{
			ActiveRecordModel::executeUpdate('DELETE FROM ' . $this->importDatabase . '.' . $table . ' WHERE lastModifiedTime<"' . $timestamp . '"');
		}

		ActiveRecordModel::executeUpdate('SET FOREIGN_KEY_CHECKS=1');
	}

	public function updateStore(ClonedStore $store, $deleted, $files)
	{
		$this->initImportSnapshot();
		$this->flush(__line__);

		$this->removeUnnecessaryCategoriesFromSnapshot($store);
$this->flush(__line__);
		$this->removeUnsyncableDataFromSnapshot();
$this->flush(__line__);
		//$this->removeUnchangedDataFromSnapshot($store->lastImport->get());
		$this->removeUnchangedDataFromSnapshot(null);
$this->flush(__line__);
		$this->executeCustomQueriesInSnapshot($store);
$this->flush(__line__);
		$this->executeTextReplaceInSnapshot($store);
$this->flush(__line__);
		$store->lastImport->set($this->timestamp);
$this->flush(__line__);

		if ($this->isOverride)
		{
			$ids = array();
			foreach (ActiveRecordModel::getDataBySQL('SELECT ID FROM ' . $this->importDatabase . '.Product') as $row)
			{
				$ids[] = $row['ID'];
			}
			
			if ($ids)
			{
				$in = ' IN (' . implode(',', $ids) . ')';
				$store->addQuery('DELETE FROM ProductPrice WHERE productID ' . $in);
				$store->addQuery('DELETE FROM ProductCategory WHERE productID ' . $in);
			}
		}

		$this->prepareDeleteQueries($store, $deleted);
$this->flush(__line__);
		$this->prepareUpdateQueries($store, $deleted);
$this->flush(__line__);
		$store->writeQueuedQueries();
$this->flush(__line__);

		$store->addQuery('UPDATE Manufacturer SET defaultImageID=(SELECT ID FROM ManufacturerImage WHERE manufacturerID=Manufacturer.ID AND position=0 LIMIT 1)');

 		$store->setFileList($files);
$this->flush(__line__);
	}

	protected function flush($text)
	{
		//echo '<!-- ' . $text . '<br /> -->';
		//echo $text . '<br />';
		echo '<span class="' . $text . '" style="font-size: 2px;">.</span>';
		flush();
		file_put_contents(ClassLoader::getRealPath('cache.') . 'synclog', $text . "\n", FILE_APPEND);
	}

	protected function prepareDeleteQueries(ClonedStore $store, $deleted)
	{
		foreach ($deleted as $table => $ids)
		{
			foreach ($ids as $key => $id)
			{
				if (!is_numeric($id))
				{
					$ids[$key] = '"' . $id . '"';
				}
			}

			if ($ids)
			{
				$store->addQuery('DELETE FROM ' . $table . ' WHERE ID IN(' . implode(', ', $ids) . ');');
			}
		}
	}

	protected function prepareUpdateQueries(ClonedStore $store)
	{
		ActiveRecord::executeUpdate('UPDATE ' . $this->importDatabase . '.Manufacturer SET protectedFields="|defaultImageID|"');
		
		foreach ($this->tables as $table)
		{
			$rows = ActiveRecord::getDataBySQL('SELECT * FROM ' . $this->importDatabase . '.' . $table);
			foreach ($this->insertTable($table, $rows) as $query)
			{
				$store->addQuery($query);
			}
		}
	}

	protected function insertTable($table, $rows, $fields = array(), $map = array(), $chunk_size = 1)
	{
		$chunks = array_chunk($rows, $chunk_size);

		$skipped = array('protectedFields', 'lastModifiedTimestamp');

		$queries = array();
		foreach($chunks as $arr)
		{
			$fields = empty($fields) ? array_keys($arr[0]) : $fields;
			if(!empty($map)){
				$tmparr    = array();
				foreach($arr as $sub){
					$tmp = array();
					foreach($map as $from)
						$tmp[] = $sub[$from];
					$tmparr[] = $tmp;
				}
				$arr = $tmparr;
			}

			foreach($arr as $sub)
			{
				$update = array();
				
				$sub = array_diff_key($sub, array_flip($skipped));

				foreach($sub as $field => $value)
				{
					if (is_numeric($value))
					{

					}
					else if (is_null($value))
					{
						$value = 'NULL';
					}
					else if (!$value)
					{
						$value = "'" . $value . "'";
					}
					else
					{
						$value = '0x' . bin2hex($value);
					}

					$sub[$field] = $field . '=' . $value;
					
					if (!$this->isOverride)
					{
						$update[$field] = $field . '=IF(COALESCE(LOCATE("|' . $field . '|", protectedFields), 0) = 0, ' . $value . ', ' . $field . ')';
					}
					else
					{
						$update[$field] = $sub[$field];
					}
					
					if ('Manufacturer' == $table)
					{
						unset($update['defaultImageID']);
					}
				}

				$queries[] = 'INSERT INTO ' . $table . ' SET ' . implode(', ', $sub) . ' ON DUPLICATE KEY UPDATE ' . implode(', ', $update);
			}
		}

		return $queries;
	}
	
	public function setOverride()
	{
		$this->isOverride = true;
	}

	public function removeUnnecessaryCategoriesFromSnapshot(ClonedStore $store)
	{
		$conds = array();
		foreach ($store->getRelatedRecordSet('ClonedStoreCategory', select(), 'Category') as $storeCat)
		{
			$cat = $storeCat->category->get();

			if (1 == $cat->getID())
			{
				continue;
			}

			$cat->load();
			$cond = lte(f('Category.lft'), $cat->lft->get());
			$cond->addAND(gte(f('Category.rgt'), $cat->rgt->get()));
			$conds[] = $cond;
		}
$this->flush(__line__);
		if (!$conds)
		{
			return;
		}
$this->flush(__line__);
		$cond = new OrChainCondition($conds);

		$ids = array();
		foreach (ActiveRecordModel::getFieldValues('Category', select($cond), array('ID')) as $id)
		{
			$ids[] = array_shift($id);
		}

		$idstr = 'IN (' . implode(', ', $ids) . ')';

		// delete unused extra category references
		// ActiveRecord::executeUpdate('DELETE FROM ' . $this->importDatabase . '.ProductCategory WHERE categoryID NOT ' . $idstr);
$this->flush(__line__);
		//var_dump('before: ' . array_shift(array_shift(ActiveRecord::getDataBySQL('SELECT COUNT(*) FROM ' . $this->importDatabase . '.Product'))));
		ActiveRecord::executeUpdate('DELETE FROM ' . $this->importDatabase . '.Product WHERE (categoryID NOT ' . $idstr . ') AND ((SELECT COUNT(*) FROM ' . $this->importDatabase . '.ProductCategory WHERE productID=Product.ID AND (ProductCategory.categoryID ' . $idstr . ')) = 0)');
		//echo 'DELETE FROM ' . $this->importDatabase . '.Product WHERE (categoryID NOT ' . $idstr . ') AND ((SELECT COUNT(*) FROM ' . $this->importDatabase . '.ProductCategory WHERE productID=Product.ID AND (ProductCategory.categoryID ' . $idstr . ')) = 0)';
		//var_dump('AFTER: ' . array_shift(array_shift(ActiveRecord::getDataBySQL('SELECT COUNT(*) FROM ' . $this->importDatabase . '.Product'))));
//die('test');
$this->flush(__line__);
		// fix main category
		ActiveRecord::executeUpdate('UPDATE ' . $this->importDatabase . '.Product SET categoryID=(SELECT categoryID FROM ' . $this->importDatabase . '.ProductCategory WHERE productID=Product.ID AND ProductCategory.categoryID IN (' . implode(',', $ids) . ') LIMIT 1) WHERE (parentID IS NULL) AND (categoryID NOT ' . $idstr . ')');
$this->flush(__line__);
		// remove redundant extra categories
		ActiveRecord::executeUpdate('DELETE ' . $this->importDatabase . '.ProductCategory FROM ' . $this->importDatabase . '.ProductCategory LEFT JOIN ' . $this->importDatabase . '.Product ON ProductCategory.productID=Product.ID WHERE ProductCategory.categoryID=Product.categoryID');
$this->flush(__line__);
		// delete unused products
		ActiveRecord::executeUpdate('DELETE FROM ' . $this->importDatabase . '.Product WHERE (categoryID IS NULL) AND (parentID IS NULL)');
$this->flush(__line__);
		// get all remaining categories
		$sql = 'SELECT lft, rgt FROM ' . $this->importDatabase . '.Category WHERE ID IN (SELECT categoryID FROM ' . $this->importDatabase . '.ProductCategory)';
		$conds = array();
		foreach (ActiveRecordModel::getDataBySQL($sql) as $row)
		{
			$cond = lte(f('Category.lft'), $row['lft']);
			$cond->addAND(gte(f('Category.rgt'), $row['rgt']));
			$conds[] = $cond;
		}
$this->flush(__line__);
		$cond = new OrChainCondition($conds);
		$ids = array();
		foreach (ActiveRecordModel::getFieldValues('Category', select($cond), array('ID')) as $id)
		{
			$ids[] = array_shift($id);
		}
$this->flush(__line__);
		$allidstr = 'IN (' . implode(', ', $ids) . ')';

		// delete unused categories
		ActiveRecord::executeUpdate('DELETE FROM ' . $this->importDatabase . '.Category WHERE (ID<>1) AND (ID NOT ' . $idstr . ') AND (ID NOT ' . $allidstr . ')');
$this->flush(__line__);
		// disable/enable existing products according to category selection
		$store->addQueuedQuery('UPDATE Category SET isEnabled=0 WHERE (ID NOT ' . $idstr . ') AND (ID NOT ' . $allidstr . ')');
		$store->addQueuedQuery('UPDATE Category SET isEnabled=1 WHERE ((ID ' . $idstr . ') OR (ID ' . $allidstr . ')) AND (COALESCE(LOCATE("|isEnabled|", protectedFields), 0) = 0)');
$this->flush(__line__);
		$store->addQueuedQuery('UPDATE Product SET isEnabled=0 WHERE (parentID IS NULL) AND (categoryID NOT ' . $idstr . ') AND (categoryID NOT ' . $allidstr . ')');
		//$store->addQueuedQuery('UPDATE Product SET isEnabled=1 WHERE (parentID IS NULL) AND ((categoryID ' . $idstr . ') OR (categoryID ' . $allidstr . ')) AND (COALESCE(LOCATE("|isEnabled|", protectedFields), 0) = 0)');
$this->flush(__line__);
	}

	public function executeCustomQueriesInSnapshot(ClonedStore $store)
	{
		$rules = $store->getRelatedRecordSet('ClonedStoreRule', select(eq(f('ClonedStoreRule.type'), ClonedStoreRule::TYPE_SQL)));

		foreach ($rules as $q)
		{
			$query = $q->query->get();

			if (!strpos($query, 'db.'))
			{
				continue;
			}

			$query = str_replace('db.', $this->importDatabase . '.', $query);

			try
			{
				ActiveRecordModel::executeUpdate($query);
			}
			catch (Exception $e)
			{
				$this->errors[] = 'SQL error: ' . $e->getMessage();
			}
		}
	}

	public function executeTextReplaceInSnapshot(ClonedStore $store)
	{
		$replace = array();
		$f = select(eq(f('ClonedStoreRule.type'), ClonedStoreRule::TYPE_TEXT));
		$f->setOrder(f('ClonedStoreRule.ID'));
		foreach ($store->getRelatedRecordSet('ClonedStoreRule', $f) as $rule)
		{
			list($entity, $field) = explode('.', $rule->field->get());
			$ruleData = $rule->toArray();
			$ruleData['entity'] = $entity;
			$ruleData['field'] = $field;
			$replace[$entity][] = $ruleData;
		}

		echo '<span style="font-size: 2px;">';

		foreach ($replace as $table => $rules)
		{
			echo '<!--';
			var_dump($rules);
			echo '-->';flush();
			//exit;

			$this->flush($table);
			$this->flush($rules);

			if ('specField' == $table)
			{
				$table = 'SpecificationStringValue';
			}

			$extraFields = '';
			if (in_array($table, array('SpecificationStringValue', 'Product')))
			{
				foreach (ActiveRecordModel::getDataBySQL('SELECT * FROM ' . $this->importDatabase . '.SpecField') as $field)
				{
					$extraFields .= ',(SELECT SpecificationStringValue.value FROM ' . $this->importDatabase . '.SpecificationStringValue WHERE productID=Product.ID AND SpecificationStringValue.specFieldID=' . $field['ID'] . ') AS field_' . $field['handle'];
				}
			}

			foreach (array('name', 'longDescription', 'shortDescription') as $parentField)
			{
				$extraFields .= ', IF(Product.parentID IS NOT NULL, ParentProduct.' . $parentField . ', Product.' . $parentField . ') AS ' . $parentField;
			}

			if ('SpecificationStringValue' == $table)
			{
				$sql = 'SELECT Product.*, Product.ID AS productID, Product.parentID AS parentProductID, SpecField.ID AS specFieldID, (SELECT value FROM SpecificationStringValue WHERE SpecificationStringValue.productID=Product.ID AND SpecificationStringValue.specFieldID=SpecField.ID) AS value, (SELECT productID FROM SpecificationStringValue WHERE SpecificationStringValue.productID=Product.ID AND SpecificationStringValue.specFieldID=SpecField.ID) AS fieldValueExists' . $extraFields . ' FROM ' . $this->importDatabase . '.Product INNER JOIN ' . $this->importDatabase . '.SpecField LEFT JOIN ' . $this->importDatabase . '.Product AS ParentProduct ON (Product.parentID=ParentProduct.ID)';
				//$sql = 'SELECT *' . $extraFields . ' FROM ' . $this->importDatabase . '.SpecField LEFT JOIN ' . $this->importDatabase . '.' . $table . ' LEFT JOIN Product ON productID=Product.ID';
			}
			else if ('Product' == $table)
			{
				$sql = 'SELECT Product.*' . $extraFields . ' FROM ' . $this->importDatabase . '.' . $table . ' LEFT JOIN Product AS ParentProduct ON (Product.parentID=ParentProduct.ID)';
			}
			else
			{
				$sql = 'SELECT * FROM ' . $this->importDatabase . '.' . $table;
			}

			$offset = 0;
			$batch = 5000;
			$modified = array();

			do
			{
				$select = $sql . ' LIMIT ' . ($batch * $offset) . ',' . $batch;
				$offset++;
				
				$rows = ActiveRecordModel::getDataBySQL($select);

				foreach ($rows as $row)
				{
					$original = $row;
					$id = array();

					$values = array();
					foreach ($row as $key => $val)
					{
						if (@unserialize($val))
						{
							$data = unserialize($val);
							$value = array_shift($data);
						}
						else
						{
							$value = $val;
						}

						$values[$key] = $value;
					}
					
					if (!empty($modified[$values['ID']]))
					{
						$values = array_merge($values, $modified[$values['ID']]);
					}

					$hasQuery = false;
					foreach ($rules as $rule)
					{
						$f = $rule['field'];
						$identifier = $f;
//						var_dump($f);

						if ($rule['query'])
						{
							$productID = ('SpecificationStringValue' == $table) ? $original['productID'] : $original['ID'];
							$count = ActiveRecordModel::getDataBySQL('SELECT COUNT(*) AS cnt FROM ' . $this->importDatabase . '.Product WHERE ID=' . $productID . ' AND ' . $rule['query']);
							$count = array_pop($count);

							if (!$count['cnt'])
							{
								continue;
							}
							$hasQuery = true;
						}

						if ('SpecificationStringValue' == $table)
						{
							if ($row['specFieldID'] != $f)
							{
								continue;
							}
							else
							{
								$f = 'value';
							}
							
							if ($rule['field'])
							{
								try
								{
									$spFld = SpecField::getInstanceByID($rule['field'], true);
									
									if ($spFld)
									{
										$identifier = 'field_' . $spFld->handle->get();
									}
								}
								catch (Exception $e)
								{
									$identifier = '';
								}
							}
						}

						if (@unserialize($row[$f]))
						{
							$data = unserialize($row[$f]);
							foreach ($data as $key => $value)
							{
								$data[$key] = $this->replace($rule, $value, $values);
								$values[$identifier] = $data[$key];
								$modified[$values['ID']][$identifier] = $data[$key];
							}

							$row[$f] = serialize($data);
						}
						else
						{
							$row[$f] = $this->replace($rule, $row[$f], $values);
							$values[$identifier] = $row[$f];
							$modified[$values['ID']][$identifier] = $row[$f];

							if ('SpecificationStringValue' == $table)
							{
								$row[$f] = serialize(array('en' => $row[$f]));
							}
						}
					}

					$row = array_diff($row, $original);

					if (!$row)
					{
						continue;
					}

					foreach($row as $field => $value)
					{
						$value = "'" . addslashes($value) . "'";

						if (substr($field, 0, 6) != 'field_')
						{
							$row[$field] = $field . '=' . $value;
						}
						else
						{
							unset($row[$field]);
						}
					}

					foreach($original as $field => $value)
					{
						if ((strpos($field, 'ID') !== false) && $value)
						{
							$value = "'" . addslashes($value) . "'";
							$id[] = $field . '=' . $value;
						}
					}

					if ('SpecificationStringValue' == $table)
					{
						$exists = $original['fieldValueExists'];
						$row = array('value' => $row['value']);
						$id = array('productID' => 'productID=' . $original['productID'], 'specFieldID' => 'specFieldID=' . $original['specFieldID']);
						$row = array_merge($row, $id);

						if ($exists)
						{
							$query = 'UPDATE ' . $this->importDatabase . '.' . $table . ' SET ' . implode(', ', $row) . ' WHERE ' . implode(' AND ', $id);
						}
						else
						{
							$query = 'INSERT INTO ' . $this->importDatabase . '.' . $table . ' SET ' . implode(', ', $row);
						}
						
						if (17 == $original['specFieldID'])
						{
							//echo '<pre>' . htmlspecialchars($query) . '</pre>' . '<Br /><Br />';
						}

						try
						{
							ActiveRecordModel::executeUpdate($query);
						}
						catch (Exception $e) { 
							echo '<div style="color:red;">' . htmlspecialchars($query) . '</div><Br /><Br />'; 
						}
					}
					else
					{
						$query = 'UPDATE ' . $this->importDatabase . '.' . $table . ' SET ' . implode(', ', $row) . ' WHERE ' . implode(' AND ', $id);

						ActiveRecordModel::executeUpdate($query);
					}

					echo '. '; flush();
				}
			}
			while ($rows);
		}

		echo '</span>';
	}

	protected function replace($rule, $value, $row)
	{
		// set initial value
		if (!$rule['find'] && !$value)
		{
			$value = $rule['repl'];
		}

		if ($rule['repl'])
		{
			$value = str_replace($rule['find'], $rule['repl'], $value);
		}
		else
		{
			$value = $rule['find'];
			foreach ($row as $k => $v)
			{
				$value = str_replace('%' . $k . '%', $v, $value);
			}
		}

		return $value;
	}

	protected function getFileList()
	{
		$root = ClassLoader::getRealPath('public.upload.');
		$l = strlen($root) + 1;
		$files = array();
		foreach ($this->find_all_files($root) as $file)
		{
			$files[substr($file, $l)] = filemtime($file);
		}
		
		foreach ($files as $file => $time)
		{
			if (substr($file, 0, 12) == 'manufacturer')
			{
				unset($files[$file]);
			}
		}

		return $files;
	}

	protected function find_all_files($dir)
	{
		$root = scandir($dir);
		$result = array();
		foreach($root as $value)
		{
			if (!strpos("$dir/$value", 'image')) { continue; }
			if($value === '.' || $value === '..') {continue;}
			if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
			foreach($this->find_all_files("$dir/$value") as $value)
			{
				$result[]=$value;
			}
		}
		return $result;
	}

	public function initImportSnapshot()
	{
		$this->copyDatabase($this->database, $this->importDatabase);
	}

	protected function createSnapshot()
	{
		$this->copyDatabase(substr($this->dbLogin['path'], 1), $this->database);
	}

	protected function copyDatabase($from, $to)
	{
$this->flush(__line__);
		try
		{
			ActiveRecordModel::executeUpdate('DROP DATABASE ' . $to);
		}
		catch (SQLException $e)
		{
			var_dump($e->getMessage());
		}
$this->flush(__line__);
		ActiveRecordModel::executeUpdate('CREATE DATABASE ' . $to);
$this->flush(__line__);
		$dbAuth = '--user=' . $this->dbLogin['user'];

		if (!empty($this->dbLogin['pass']))
		{
			$dbAuth .= ' --password=\'' . $this->dbLogin['pass'] . "'";
		}

		$tmpPath = ClassLoader::getRealPath('cache.') . 'dump.sql';

		//$r = exec('mysqldump ' . $dbAuth . ' ' . $from . ' | mysql ' . $dbAuth . ' ' . $to, $a, $ret);

		exec('/bin/bash /home/galssess/www/copy.sh ' . $from . ' ' . $to, $a, $ret);
//var_dump($a, $ret);

		/*
		$r = exec('mysqldump -v --force ' . $dbAuth . ' ' . $from . ' > ' . $tmpPath, $a, $ret);

		var_dump('mysqldump -v ' . $dbAuth . ' ' . $from . ' > ' . $tmpPath);
		var_dump($a);
$this->flush(__line__);
		exec('mysql ' . $dbAuth . ' ' . $to . ' < ' . $tmpPath, $a);
		var_dump('mysql ' . $dbAuth . ' ' . $to . ' < ' . $tmpPath);
		*/

$this->flush(__line__);

//		unlink($tmpPath);
$this->flush(__line__);
	}

	protected function getDBLogin()
	{
		return parse_url(include ClassLoader::getRealPath('storage.configuration.') . 'database.php');
	}

	public function getIDFile()
	{
		return ClassLoader::getRealPath('storage.') . 'recordIDs.php';
	}

	public function getTimestampFile()
	{
		return ClassLoader::getRealPath('storage.') . 'importTimestamp.php';
	}

	public static function isTableSynced($table)
	{
		return !in_array($table, self::$ignoredTables);
	}

	public function getImportDatabase()
	{
		return $this->importDatabase;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}

?>
