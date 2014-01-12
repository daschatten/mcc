<?php

Yii::import('application.models.mythtv._base.BaseIptvChannel');

class IptvChannel extends BaseIptvChannel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}