<?php

Yii::import('application.models.mythtv._base.BaseVideocollection');

class Videocollection extends BaseVideocollection
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}