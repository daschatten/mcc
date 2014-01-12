<?php

Yii::import('application.models.mythtv._base.BaseJobqueue');

class Jobqueue extends BaseJobqueue
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}