<?php

Yii::import('application.models.mythtv._base.BaseChannel');

class Channel extends BaseChannel
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public static function getVisibleChannelList()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "visible = 1";
        $criteria->order = "1*channum";

        return Channel::model()->findAll($criteria);
    }

    public function getNumName()
    {
        return "$this->channum - $this->name";
    }
}
