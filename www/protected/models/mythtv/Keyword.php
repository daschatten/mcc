<?php

Yii::import('application.models.mythtv._base.BaseKeyword');

class Keyword extends BaseKeyword
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}