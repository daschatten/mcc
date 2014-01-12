<?php

Yii::import('application.models.mythtv._base.BaseEitCache');

class EitCache extends BaseEitCache
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}