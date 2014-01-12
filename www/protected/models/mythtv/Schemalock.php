<?php

Yii::import('application.models.mythtv._base.BaseSchemalock');

class Schemalock extends BaseSchemalock
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}