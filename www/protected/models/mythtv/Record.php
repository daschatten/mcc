<?php

Yii::import('application.models.mythtv._base.BaseRecord');

class Record extends BaseRecord
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function rules() {
		return array(
			array('season, episode, inetref, next_record, last_record, last_delete', 'safe'),
			array('season, episode, recpriority, autoexpire, maxepisodes, maxnewest, startoffset, endoffset, dupmethod, dupin, autotranscode, autocommflag, autouserjob1, autouserjob2, autouserjob3, autouserjob4, autometadata, findday, findid, inactive, parentid, transcoder, prefinput, avg_delay', 'numerical', 'integerOnly'=>true),
			array('type, chanid, search, filter', 'length', 'max'=>10),
			array('title, subtitle, profile', 'length', 'max'=>128),
			array('description', 'length', 'max'=>16000),
			array('category', 'length', 'max'=>64),
			array('recgroup, playgroup, storagegroup', 'length', 'max'=>32),
			array('station', 'length', 'max'=>20),
			array('seriesid, programid, inetref', 'length', 'max'=>40),
			array('starttime, startdate, endtime, enddate, findtime', 'safe'),
			array('type, chanid, starttime, startdate, endtime, enddate, title, subtitle, description, category, profile, recpriority, autoexpire, maxepisodes, maxnewest, startoffset, endoffset, recgroup, dupmethod, dupin, station, seriesid, programid, search, autotranscode, autocommflag, autouserjob1, autouserjob2, autouserjob3, autouserjob4, autometadata, findday, findtime, findid, inactive, parentid, transcoder, playgroup, prefinput, storagegroup, avg_delay, filter', 'default', 'setOnEmpty' => true, 'value' => null),
			array('recordid, type, chanid, starttime, startdate, endtime, enddate, title, subtitle, description, season, episode, category, profile, recpriority, autoexpire, maxepisodes, maxnewest, startoffset, endoffset, recgroup, dupmethod, dupin, station, seriesid, programid, inetref, search, autotranscode, autocommflag, autouserjob1, autouserjob2, autouserjob3, autouserjob4, autometadata, findday, findtime, findid, inactive, parentid, transcoder, playgroup, prefinput, next_record, last_record, last_delete, storagegroup, avg_delay, filter', 'safe', 'on'=>'search'),
		);
	}
}
