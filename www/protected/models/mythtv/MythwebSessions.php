<?php

Yii::import('application.models.mythtv._base.BaseMythwebSessions');

class MythwebSessions extends BaseMythwebSessions
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}