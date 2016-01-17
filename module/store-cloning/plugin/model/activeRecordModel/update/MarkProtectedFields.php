<?php

ClassLoader::import('module.store-cloning.application.model.ClonedStoreUpdater');

class MarkProtectedFields extends ModelPlugin
{
	public function process()
	{
		if (ActiveRecordModel::getApplication()->getConfig()->get('CLONE_STORE_TYPE') == 'CLONE_STORE_MASTER')
		{
			return;
		}

		if (!ClonedStoreUpdater::isTableSynced(get_class($this->object)))
		{
			return;
		}

		$protectedFields = array();
		foreach ($this->object->getSchema()->getFieldList() as $fieldName => $field)
		{
			$val = $this->object->getFieldValue($fieldName);
			
			$isModified = $this->object->getField($fieldName)->isModified();
			
			if ($isModified && $val)
			{
				if (is_array($val))
				{
					// empty serialized array
					if (!array_filter($val))
					{
						continue;
					}

					$initial = $this->object->getField($fieldName)->getInitialValue();

					if (is_array($initial))
					{
						foreach ($val as $key => $value)
						{
							$val[$key] = strip_tags($value);
						}

						foreach ($initial as $key => $value)
						{
							$initial[$key] = strip_tags($value);
						}

						if (!array_diff($val, $initial))
						{
							continue;
						}
					}
				}

				$protectedFields[] = $fieldName;
			}
		}
		
		if (('SpecificationStringValue' == get_class($this->object)) && $this->object->value->isModified())
		{
			$protectedFields[] = 'value';
		}

		if (!$protectedFields)
		{
			return;
		}

		$f = new ARUpdateFilter();
		foreach ($protectedFields as $key => $field)
		{
			$f->addModifier('protectedFields' . str_repeat(' ', $key), new ARExpressionHandle('IF(LOCATE("|' . $field . '|", protectedFields) > 0, protectedFields, CONCAT(COALESCE(protectedFields, ""), "|' . $field . '|"))'));
		}

		$this->object->updateFilter = $f;
	}
}

?>
