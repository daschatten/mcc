<?php

Yii::import('application.models.mythtv._base.BaseProgram');

class Program extends BaseProgram
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}