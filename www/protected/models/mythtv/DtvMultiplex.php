<?php

Yii::import('application.models.mythtv._base.BaseDtvMultiplex');

class DtvMultiplex extends BaseDtvMultiplex
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}