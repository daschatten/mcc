<?php

Yii::import('application.models.mythtv._base.BaseNetflix');

class Netflix extends BaseNetflix
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}