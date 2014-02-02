<?php

Yii::import('application.models.mythtv._base.BaseProgram');

class Program extends BaseProgram
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'channel' => array(self::BELONGS_TO, 'Channel', 'chanid'),
        );
    }

    public function record($template, $type = 1)
    {
        try{
           Record::addRecord($template, $this, $type);
        }catch(Exception $e){
            throw $e;
        }

    }
}
