<?php

ClassLoader::import("application.controller.backend.abstract.ActiveGridController");
ClassLoader::import("module.store-cloning.application.controller.ClonedApiController");
ClassLoader::import("module.store-cloning.application.model.ClonedStore");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreCategory");
ClassLoader::import("module.store-cloning.application.model.ClonedStoreRule");

/**
 *
 * @package module.store-cloning.application.controller.backend
 * @author Integry Systems
 */
class ClonedStoreController extends ActiveGridController
{
	public function index()
	{
		return $this->getGridResponse();
	}

	public function add()
	{
		$clonedStore = ClonedStore::getNewInstance();
		$clonedStore->domain->set($this->translate('newstore.com'));
		$clonedStore->save();

		return new JSONResponse($clonedStore->toArray());
	}

	public function edit()
	{
		$clonedStore = ActiveRecordModel::getInstanceById('ClonedStore', $this->request->get('id'), true);

		$response = new ActionResponse('clonedStore', $clonedStore->toArray());
		$form = $this->buildForm();

		$form->setData($clonedStore->toArray());

		$response->set('form', $form);

		return $response;
	}

	public function save()
	{
		$clonedStore = ActiveRecordModel::getInstanceById('ClonedStore', $this->request->get('id'), true);
		$validator = $this->buildValidator();

		if ($validator->isValid())
		{
			$clonedStore->loadRequestData($this->request);
			$clonedStore->save();
			return new JSONResponse(array('clonedStore' => $clonedStore->toArray()), 'success', $this->translate('Store configuration was successfully saved'));
		}
		else
		{
			return new JSONResponse(array('errors' => $validator->getErrorList()), 'failure');
		}
	}

	public function categories()
	{
		// get store categories
		$selected = array();
		foreach ($this->getStore()->getRelatedRecordSetArray('ClonedStoreCategory', select()) as $cat)
		{
			$selected[$cat['categoryID']] = true;
		}

		// load tree
		$rootID = 1;
		$f = new ARSelectFilter(new EqualsCond(new ARFieldHandle('Category', 'isEnabled'), true));
		$categories = ActiveRecordModel::getRecordSetArray('Category', Category::getInstanceByID($rootID, true)->getBranchFilter($f));

		$index = array($rootID => array('children' => array(), 'key' => 1, 'title' => 'Root', 'expand' => true));
		foreach ($categories as $key => $category)
		{
			$cat = array('key' => $category['ID'], 'title' => $category['name_lang']);
			if (isset($selected[$category['ID']]) || !empty($index[$category['parentNodeID']]['select']))
			{
				$cat['select'] = true;
			}

			$index[$category['ID']] = $cat;
			$index[$category['parentNodeID']]['children'][] =& $index[$category['ID']];
		}

		$response = new ActionResponse();
		$response->set('tree', json_encode(array($index[1])));
		$response->set('store', $this->getStore()->toArray());

		return $response;
	}

	public function saveCategories()
	{
		$store = $this->getStore();

		if ('nochange' != $this->request->get('categories'))
		{
			$store->deleteRelatedRecordSet('ClonedStoreCategory');
			foreach (explode(',', $this->request->get('categories')) as $cat)
			{
				ClonedStoreCategory::getNewInstance(Category::getInstanceByID($cat), $store)->save();
			}
		}

		return new JSONResponse(null, 'success', 'Store category settings saved successfully');
	}

	public function textRules($type = ClonedStoreRule::TYPE_TEXT)
	{
		$rules = $this->getRules($type);

		$fields = $this->getApiFields($type);
		$response = new ActionResponse();
		$response->set('rules', $rules);
		$response->set('fields', $fields);
		$response->set('store', $this->getStore()->toArray());
		return $response;
	}

	public function sqlRules()
	{
		return $this->textRules(ClonedStoreRule::TYPE_SQL);
	}

	public function saveTextRules($type = ClonedStoreRule::TYPE_TEXT)
	{
		$store = $this->getStore();

		$store->deleteRelatedRecordSet('ClonedStoreRule', new ARDeleteFilter(eq(f('ClonedStoreRule.type'), $type)));
		$req = $this->request->toArray();

		$find = $this->request->get('find');
		$repl = $this->request->get('repl');
		$query = $this->request->get('query');

		foreach ($this->request->get('field') as $key => $field)
		{
			$rule = ClonedStoreRule::getNewInstance($store, $type);
			$rule->field->set($field);

			if ($type == ClonedStoreRule::TYPE_TEXT)
			{
				$rule->find->set($find[$key]);
				$rule->repl->set($repl[$key]);
				$rule->query->set($query[$key]);

				if (!$rule->find->get() && !$rule->repl->get())
				{
					continue;
				}
			}
			else
			{
				$rule->query->set($query[$key]);

				if (!$rule->query->get())
				{
					continue;
				}
			}

			$rule->save();
		}

		return new JSONResponse(null, 'success', 'Store rules have been saved successfully');
	}

	public function saveSqlRules()
	{
		return $this->saveTextRules(ClonedStoreRule::TYPE_SQL);
	}

	public function getApiFields($type)
	{
		$this->loadLanguageFile('Api');
		$this->loadLanguageFile('backend/Settings/API');
		$this->loadLanguageFile('backend/CsvImport');
		$this->loadLanguageFile('backend/UserGroup');

		$c = new ClonedApiController($this->application);
		$doc = $c->getDocInfo();

		$classes = array_diff_key($doc, array_flip(array('CustomerOrderApi', 'UserApi')));

		$fields = array();

		$ignoredFields = array('Category.lft', 'Product.type',  'Product.rating', 'Product.shippingSurchargeAmount', 'Product.minimumQuantity', 'Product.shippingWeight', 'Product.fractionalStep');

		foreach ($classes as $model => $data)
		{
			$inst = $data['inst'];
			$this->loadLanguageFile('backend/' . $inst->getClassName());

			$this->request->set(ApiReader::API_PARSER_CLASS_NAME, 'Xml' . get_class($inst) . 'Reader');
			$inst->loadRequest(false);

			$searchFields = array();
			$e = error_reporting();
			error_reporting(E_STRICT);
			foreach ((array)$inst->getParser()->getValidSearchFields($inst->getClassName()) as $key => $field)
			{
				$fieldName = $field[0]->toString();
				$translation = $this->translate($fieldName);

				if ($type == ClonedStoreRule::TYPE_TEXT)
				{
					list($foo, $dbField) = explode('.', $fieldName);
					if (in_array($dbField, array('position')) || in_array($fieldName, $ignoredFields) || ('ProductPriceApi' == $model) || ($translation == $fieldName) || (substr($key, -2) == 'ID') || (substr($translation, 0, 3) == 'Is ')  || (substr($dbField, 0, 2) == 'is') || (substr($dbField, 0, 4) == 'date') || strpos($key, 'Count'))
					{
						continue;
					}
				}

				$searchFields[$fieldName] = array('field' => $key);
				if ($translation != $fieldName)
				{
					$searchFields[$fieldName]['descr'] = $translation;
				}

				$searchFields[$fieldName]['descr'] .= ' (%' . $dbField . '%)';
			}
			error_reporting($e);

			if ('ProductApi' == $model)
			{
				$searchFields['Product.custom'] = array('field' => 'Product.custom', 'descr' => 'Custom variation field (%custom%)');

				foreach (Category::getRootNode()->getRelatedRecordSetArray('SpecField', select(eq(f('SpecField.dataType'), SpecField::DATATYPE_TEXT))) as $field)
				{
					$f = 'specField.' . $field['ID'];
					$searchFields[$f] = array('field' => $f, 'descr' => $field['name_lang'] . ' (%field_' . $field['handle'] . '%)');
				}
			}

			if ($searchFields)
			{
				$fields[$model] = $searchFields;
			}
/*
			var_dump($searchFields);
			continue;

			if (!$importer)
			{
					continue;
			}


			$createFields = array();
			$className = $inst->getClassName();
			foreach ($importer->getFields() as $groupName => $fields)
			{
				$apiFields = array();
				foreach ($fields as $field => $translation)
				{
					list($class, $column) = explode('.', $field);
					if ($class == $className)
					{
						$field = $column;
					}

					$field = str_replace('.', '_', $field);
					$apiFields[$field] = $translation;
				}

				$createFields[$this->translate($groupName)] = $apiFields;
			}

			var_dump($createFields);
			*/
		}

		return $fields;
	}

	private function getRules($type)
	{
		$f = select(eq(f('ClonedStoreRule.type'), $type));
		$f->setOrder(f('ClonedStoreRule.ID'));
		return $this->getStore()->getRelatedRecordSetArray('ClonedStoreRule', $f);
	}

	public function changeColumns()
	{
		parent::changeColumns();
		return $this->getGridResponse();
	}

	private function getGridResponse()
	{
		$this->loadLanguageFile('backend/Product');

		$response = new ActionResponse();
		$this->setGridResponse($response);
		$response->set('id', $this->request->get('id'));
		return $response;
	}

	protected function getClassName()
	{
		return 'ClonedStore';
	}

	protected function getCSVFileName()
	{
		return 'stores.csv';
	}

	protected function getSelectFilter()
	{
		$f = new ARSelectFilter();

		return $f;
	}

	protected function getDefaultColumns()
	{
		return array('ClonedStore.ID', 'ClonedStore.domain');
	}

	protected function setDefaultSortOrder(ARSelectFilter $filter)
	{
		$filter->setOrder(new ARFieldHandle($this->getClassName(), 'ID'), 'ASC');
	}

	private function buildValidator()
	{
		$validator = $this->getValidator("ClonedStore", $this->request);
		$validator->addCheck("domain", new IsNotEmptyCheck($this->translate("Domain name is empty")));
		$validator->addCheck("apiKey", new IsNotEmptyCheck($this->translate("API key is empty")));

		return $validator;
	}

	/**
	 * Builds a category form instance
	 *
	 * @return Form
	 */
	private function buildForm()
	{
		return new Form($this->buildValidator());
	}

	private function getStore()
	{
		return ActiveRecordModel::getInstanceByID('ClonedStore', $this->request->get('id'), true);
	}
}

?>
