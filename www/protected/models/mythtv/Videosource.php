<?php

Yii::import('application.models.mythtv._base.BaseVideosource');

class Videosource extends BaseVideosource
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}