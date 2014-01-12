<?php

Yii::import('application.models.mythtv._base.BaseMoviesTheaters');

class MoviesTheaters extends BaseMoviesTheaters
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}