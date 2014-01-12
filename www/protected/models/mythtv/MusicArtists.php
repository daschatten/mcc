<?php

Yii::import('application.models.mythtv._base.BaseMusicArtists');

class MusicArtists extends BaseMusicArtists
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}