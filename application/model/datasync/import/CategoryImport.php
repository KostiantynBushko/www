<?php

ClassLoader::import('application.model.datasync.DataImport');
ClassLoader::import('application.model.category.Category');
ClassLoader::import('application.controller.backend.abstract.ActiveGridController');

/**
 *  Handles category import logic
 *
 *  @package application.model.datasync.import
 *  @author Integry Systems
 */
class CategoryImport extends DataImport
{
	public function getFields()
	{
		$this->loadLanguageFile('backend/Category');

		$custom = array('Category.parentID' => 'numeric');

		foreach (ActiveGridController::getSchemaColumns('Category', $this->application, $custom) as $key => $data)
		{
			$fields[$key] = $this->translate($data['name']);
		}
		unset($fields['Category.rgt']);
		unset($fields['Category.availableProductCount']);
		unset($fields['Category.activeProductCount']);
		unset($fields['Category.totalProductCount']);

		$groupedFields = $this->getGroupedFields($fields);

		return $groupedFields;
	}

	public function isRootCategory()
	{
		return true;
	}

	protected function getInstance($record, CsvImportProfile $profile)
	{
		$fields = $profile->getSortedFields();

		if (isset($fields['Category']['parentID']))
		{
			try
			{
				$parent = Category::getInstanceByID($record[$fields['Category']['parentID']], true);
			}
			catch (ARNotFoundException $e)
			{
				$parent = null;
			}
		}

		if (isset($fields['Category']['ID']))
		{
			try
			{
				$instance = Category::getInstanceByID($record[$fields['Category']['ID']], true);
			}
			catch (ARNotFoundException $e)
			{
				if (isset($parent))
				{
					// parent category not found, ignoring
					if (is_null($parent))
					{
						return null;
					}
				}
				else
				{
					$parent = Category::getRootNode();
				}

				$instance = Category::getNewInstance($parent);
				$instance->isEnabled->set(true);
				$instance->setID($record[$fields['Category']['ID']]);
			}
		}

		return $instance;
	}

	public function afterImport()
	{
		Category::reindex();
	}

	protected function set_parentID($instance, $value)
	{
		try
		{
			$parent = Category::getInstanceByID($value, true);
			$instance->parentNode->set($parent);
		}
		catch (ARNotFoundException $e)
		{
			return;
		}
	}
}

?>