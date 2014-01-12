<?php

Yii::import('application.models.mythtv._base.BaseMythlog');

class Mythlog extends BaseMythlog
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}