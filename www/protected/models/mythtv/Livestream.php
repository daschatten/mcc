<?php

Yii::import('application.models.mythtv._base.BaseLivestream');

class Livestream extends BaseLivestream
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}