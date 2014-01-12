<?php

Yii::import('application.models.mythtv._base.BaseStreams');

class Streams extends BaseStreams
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}