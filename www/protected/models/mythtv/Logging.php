<?php

Yii::import('application.models.mythtv._base.BaseLogging');

class Logging extends BaseLogging
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}