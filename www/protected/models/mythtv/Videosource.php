<?php

Yii::import('application.models.mythtv._base.BaseVideosource');

class Videosource extends BaseVideosource
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'channels' => array(self::STAT, 'Channel', 'sourceid'),
            'visibleChannels' => array(self::STAT, 'Channel', 'sourceid', 'condition' => 'visible=1'),
            'multiplexes' => array(self::STAT, 'DtvMultiplex', 'sourceid'),
            'visibleMultiplexes' => array(self::STAT, 'DtvMultiplex', 'sourceid', 'condition' => 'visible=1'),
        );
    }
}
