<?php

Yii::import('application.models.mythtv._base.BaseOldrecorded');

class Oldrecorded extends BaseOldrecorded
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function relations()
    {
        return array(
            'channel'=>array(self::BELONGS_TO, 'Channel', 'chanid'),
        );
    }

}
