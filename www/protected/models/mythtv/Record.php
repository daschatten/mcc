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

    public static function addRecord($template, $program, $type = 1)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "title = :title";
        $criteria->params = array(
            ':title' => $template,
        );

        $model = Record::model()->find($criteria);

        if(!$model instanceof Record)
        {
            throw new Exception("Record template with name '$template' not found!");
        }
        

        $model->recordid = null;
        $model->setIsNewRecord(true);

        $model->type = $type;
        $model->title = $program->title;
        $model->starttime = $program->starttime;
        $model->starttime = date('H:i:s', strtotime($program->starttime));
        $model->startdate = date('Y-m-d', strtotime($program->starttime));
        $model->endtime = date('H:i:s', strtotime($program->endtime));
        $model->enddate = date('Y-m-d', strtotime($program->endtime));
        $model->chanid = $program->chanid; 
        $model->subtitle = $program->subtitle;
        $model->description = $program->description;
        $model->station = $program->channel->callsign;
        $model->seriesid = $program->seriesid;
        $model->programid = $program->programid;

        $model->findid = (int) (strtotime($program->starttime) / 60 / 60 /24) + 719528 + 1;
        $model->findtime = date('H:i:s', strtotime($program->starttime." UTC"));
        $model->inactive = 1;

        if(!$model->save())
        {
        
            throw new Exception("Record rule save failed!");
        }

        try{
            Record::triggerScheduler($model->recordid);
        }catch(Exception $e){
            throw $e;
        }

    }

    public static function triggerScheduler($recordid)
    {
        $dvr = new ServiceDvr();
        if(!$dvr->EnableRecordSchedule($recordid))
        {
            throw new Exception("Webservice request '$dvr->EnableRecordSchedule($model->recordid)' failed!");
        }

    }
}
