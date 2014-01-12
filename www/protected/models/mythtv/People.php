<?php

Yii::import('application.models.mythtv._base.BasePeople');

class People extends BasePeople
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}