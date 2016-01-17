<?php

class SaveProtectedFields extends ModelPlugin
{
	public function process()
	{
		if (!empty($this->object->updateFilter))
		{
			$this->object->updateRecord($this->object->updateFilter);
			unset($this->object->updateFilter);
		}
	}
}

?>
