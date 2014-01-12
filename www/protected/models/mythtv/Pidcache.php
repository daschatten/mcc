<?php

Yii::import('application.models.mythtv._base.BasePidcache');

class Pidcache extends BasePidcache
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}