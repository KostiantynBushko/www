<?php

require_once(realpath(dirname(__FILE__) . '/../../../test/test/Initialize.php'));
//require_once dirname(__FILE__) . '/../../../test/test/Initialize.php';

ClassLoader::import('module.store-cloning.application.model.*');
ClassLoader::import('application.model.category.Category');
ClassLoader::import('application.model.product.Product');

class TestStoreCloning extends LiveCartTest
{
	private $master;

	private $stores = array();

	private $categories = array();

	public function setUp()
	{
		parent::setUp();

		ActiveRecordModel::executeUpdate('DELETE FROM ClonedStore');

		$this->usd = ActiveRecordModel::getNewInstance('Currency');
		$this->usd->setID('ZZZ');
		$this->usd->save(ActiveRecord::PERFORM_INSERT);

		@unlink(ClonedStoreUpdater::getTimestampFile());
		@unlink(ClonedStoreUpdater::getIDFile());

		// create stores
		for ($k = 0; $k <= 0; $k++)
		{
			$this->stores[$k] = ClonedStore::getNewInstance();
			$this->stores[$k]->domain->set($k);
			$this->stores[$k]->save();

			echo $this->stores[$k]->lastImport->get();
		}

		// create categories
		$root = Category::getRootNode();

		for ($k = 0; $k <= 5; $k++)
		{
			$this->categories[] = $this->createCategory($root, $k);
		}

		$this->categories['1.1'] = $this->createCategory($this->categories[1], '1.1');
		$this->categories['1.2'] = $this->createCategory($this->categories[1], '1.2');

		$this->categories['1.2.1'] = $this->createCategory($this->categories['1.2'], '1.2.1');
		$this->categories['1.2.2'] = $this->createCategory($this->categories['1.2'], '1.2.2');

		usleep(1500000);
	}

	private function createCategory(Category $parent, $name)
	{
		$cat = Category::getNewInstance($parent);
		$cat->setValueByLang('name', null, $name);
		$cat->isEnabled->set(true);
		$cat->save();

		return $cat;
	}

	public function testAllCategorySync()
	{
		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertRecordCountEqual('Category');
		$this->assertRecordCountEqual('Product');

		try
		{
			$this->assertRecordCountEqual('CustomerOrder');
			$this->fail('CustomerOrder table should not be synchronized');
		}
		catch (Exception $e)
		{}
	}

	public function testCategories()
	{
		ClonedStoreCategory::getNewInstance($this->categories['1.2.2'], $this->stores[0])->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertRecordCount('Category', 4);

		// add new syncable category - should still import even though the category itself is not changed
		ClonedStoreCategory::getNewInstance($this->categories['1.2.1'], $this->stores[0])->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertRecordCount('Category', 5);
	}

	public function testProductSyncNoMatchingProducts()
	{
		for ($k = 0; $k <= 1; $k++)
		{
			$product = Product::getNewInstance($this->categories['1.2.1']);
			$product->sku->set($k);
			$product->save();
		}

		ClonedStoreCategory::getNewInstance($this->categories['1.2.2'], $this->stores[0])->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertRecordCount('Product', 0);
	}

	public function testProductSyncMatchingProductParentCat()
	{
		for ($k = 0; $k <= 1; $k++)
		{
			$product = Product::getNewInstance($this->categories['1.2.1']);
			$product->sku->set($k);
			$product->save();
		}

		ClonedStoreCategory::getNewInstance($this->categories['1.2.2'], $this->stores[0])->save();
		$product->category->set($this->categories['1.2.2']);
		$product->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertRecordCount('Product', 1);
	}

	public function testProductSyncMatchingProductExtraCat()
	{
		for ($k = 0; $k <= 1; $k++)
		{
			$product = Product::getNewInstance($this->categories['1.2.1']);
			$product->sku->set($k);
			$product->save();
		}

		ClonedStoreCategory::getNewInstance($this->categories['1.2.2'], $this->stores[0])->save();
		ProductCategory::getNewInstance($product, $this->categories['1.2.1'])->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertRecordCount('Product', 1);
	}

	public function testSQLRules()
	{
		$product = Product::getNewInstance($this->categories['1.2.1']);
		$product->save();
		$product->setPrice($this->usd->getID(), 100);
		$product->save();

		$rule = ClonedStoreRule::getNewInstance($this->stores[0], ClonedStoreRule::TYPE_SQL);
		$rule->query->set('UPDATE db.ProductPrice set price=price*1.1');
		$rule->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertRecordCount('ProductPrice', 1);

		$row = ActiveRecord::getDataBySQL('SELECT * FROM ' . $updater->getImportDatabase() . '.ProductPrice');
		$row = array_shift($row);

		$this->assertEqual($row['price'], 110);

		$this->assertEqual(count($updater->getErrors()), 0);
	}

	public function testInvalidSQLRules()
	{
		$product = Product::getNewInstance($this->categories['1.2.1']);
		$product->save();
		$product->setPrice($this->usd->getID(), 100);
		$product->save();

		$rule = ClonedStoreRule::getNewInstance($this->stores[0], ClonedStoreRule::TYPE_SQL);
		$rule->query->set('UPDATE db.ProductPrice "UH OH, A TYPO..." set price=price*1.1');
		$rule->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$this->assertEqual(count($updater->getErrors()), 1);
	}

	public function testTextRules()
	{
		$schema = Product::getSchemaInstance('Product');
		$schema->registerField(new ArField('custom', ARText::instance()));

		$product = Product::getNewInstance($this->categories['1.2.1']);

		$product->sku->set('testing');
		$product->custom->set('something else');
		$product->setValueByLang('name', null, 'product name');
		$product->save();

		$rule = ClonedStoreRule::getNewInstance($this->stores[0], ClonedStoreRule::TYPE_TEXT);
		$rule->field->set('Product.sku');
		$rule->find->set('sti');
		$rule->repl->set('blah');
		$rule->save();

		$rule = ClonedStoreRule::getNewInstance($this->stores[0], ClonedStoreRule::TYPE_TEXT);
		$rule->field->set('Product.name');
		$rule->find->set('ct');
		$rule->repl->set('kta');
		$rule->save();

		$rule = ClonedStoreRule::getNewInstance($this->stores[0], ClonedStoreRule::TYPE_TEXT);
		$rule->field->set('Product.custom');
		$rule->find->set('thing');
		$rule->repl->set('nothing');
		$rule->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$row = ActiveRecord::getDataBySQL('SELECT * FROM ' . $updater->getImportDatabase() . '.Product WHERE ID=' . $product->getID());
		$row = array_shift($row);

		$this->assertEqual($row['sku'], 'teblahng');
		$this->assertEqual($row['custom'], 'somenothing else');

		$name = unserialize($row['name']);

		$this->assertEqual($name[$this->getApplication()->getDefaultLanguageCode()], 'produkta name');
	}

	public function testTextRulesSpecField()
	{
		$field = SpecField::getNewInstance(Category::getRootNode(), SpecField::DATATYPE_TEXT, SpecField::TYPE_TEXT_ADVANCED);
		$field->save();

		$product = Product::getNewInstance($this->categories['1.2.1']);
		$product->sku->set('testing');
		$product->save();

		$product->setAttributeValueByLang($field, $this->getApplication()->getDefaultLanguageCode(), 'Attribute value');
		$product->save();

		$rule = ClonedStoreRule::getNewInstance($this->stores[0], ClonedStoreRule::TYPE_TEXT);
		$rule->field->set('specField.' . $field->getID());
		$rule->find->set('value');
		$rule->repl->set('replaced');
		$rule->save();

		$updater = $this->getUpdater();
		$updater->syncAll();

		$row = ActiveRecord::getDataBySQL('SELECT * FROM ' . $updater->getImportDatabase() . '.SpecificationStringValue WHERE productID=' . $product->getID());
		$row = array_shift($row);

		$name = unserialize($row['value']);

		$this->assertEqual($name[$this->getApplication()->getDefaultLanguageCode()], 'Attribute replaced');
	}

	public function testDeactivatedCategories()
	{

	}

	public function testFileUpdate()
	{

	}

	private function assertRecordCountEqual($table)
	{
		list($original, $cloned) = $this->getRecordCounts($table);
		return $this->assertEqual($original, $cloned);
	}

	private function assertRecordCount($table, $count)
	{
		$this->assertEqual($count, array_shift(array_shift(ActiveRecord::getDataBySQL('SELECT COUNT(*) FROM testCloning_import.' . $table))));
	}

	private function getUpdater()
	{
		return new ClonedStoreUpdater($this->getApplication(), 'testCloning');
	}

	private function getRecordCounts($table)
	{
		return array(array_shift(array_shift(ActiveRecord::getDataBySQL('SELECT COUNT(*) FROM ' . $table))),
				     array_shift(array_shift(ActiveRecord::getDataBySQL('SELECT COUNT(*) FROM testCloning_import.' . $table))));
	}
}

?>
