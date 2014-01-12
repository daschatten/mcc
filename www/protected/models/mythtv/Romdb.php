<?php

Yii::import('application.models.mythtv._base.BaseRomdb');

class Romdb extends BaseRomdb
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}