<?php

Yii::import('application.models.mythtv._base.BaseVideocast');

class Videocast extends BaseVideocast
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}