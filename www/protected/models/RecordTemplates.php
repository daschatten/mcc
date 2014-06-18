<?php

Yii::import('application.models._base.BaseRecordTemplates');

class RecordTemplates extends BaseRecordTemplates
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'record' => array(self::BELONGS_TO, 'Record', 'record_id'),
        );
    }
}
