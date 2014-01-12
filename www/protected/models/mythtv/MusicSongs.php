<?php

Yii::import('application.models.mythtv._base.BaseMusicSongs');

class MusicSongs extends BaseMusicSongs
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}