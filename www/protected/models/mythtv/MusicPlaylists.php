<?php

Yii::import('application.models.mythtv._base.BaseMusicPlaylists');

class MusicPlaylists extends BaseMusicPlaylists
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}