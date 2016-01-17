<?php

ClassLoader::import('application.model.eav.EavObject');
ClassLoader::import('application.model.eav.EavField');

class InitEyeExamFieldsAndClass extends ControllerPlugin
{
	public function process()
	{
		static $beenHere = null;

		if (!$beenHere)		
		{
            EavObject::defineSchema();
			$schema = EavField::getSchemaInstance('EavObject');
            $schema->registerField(new ARForeignKeyField("eyeExamRequestID", "EyeExamRequest", "ID", null, ARInteger::instance()), false);

			$eafFieldInst = EavField::getNewInstance('EavField');
            $eafFieldInst->registerClass('EyeExamRequest',8);
		}

		$beenHere = true;
	}
}

?>
