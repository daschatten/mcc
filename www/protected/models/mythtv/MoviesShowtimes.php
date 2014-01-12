<?php

Yii::import('application.models.mythtv._base.BaseMoviesShowtimes');

class MoviesShowtimes extends BaseMoviesShowtimes
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}