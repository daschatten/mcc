<?php

class ServiceGuide extends MythService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetProgramDetails($dataprovider=false,$StartTime=null,$ChanId=null)
    {
        if($ChanId == null)
        {
            $chan = Channel::model()->visible()->order()->find();
            $ChanId = $chan->chanid;
        }

        if($StartTime == null)
        {
            $now = MysqlHelper::Timestamp2Mysql(time());
            print_r($now);
            $criteria = new CDbCriteria();
            $criteria->condition="chanid=$ChanId and starttime <= '$now' and endtime >= '$now'";
            $program = MProgram::model()->find($criteria);

            $StartTime = MysqlHelper::FixMysqlTimestamp($program->starttime); 
        }

        $uri = $this->mythbackenduri."/Guide/GetProgramDetails?StartTime=$StartTime&ChanId=$ChanId";

        Yii::trace("[ServiceGuide::GetProgramDetails] uri: '$uri'");

        try{
            $response = \Httpful\Request::get($uri)->expectsXml()->send();
            print_r($response);exit;
            if(!$dataprovider)
            {
                return $response->body;
            }else{
                $dataProvider=new CArrayDataProvider($response->body, array(
                    'id'=>'false',
                    'pagination'=>false,
                ));
                return $dataProvider;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function GetProgramGuide($dataprovider=false, $StartTime=null, $EndTime=null, $StartChanId=null, $NumChannels=null, $Details=false)
    {
        if($StartChanId == null)
        {
            $chan = Channel::model()->visible()->order()->find();
            $StartChanId = $chan->chanid;
        }

        if($StartTime == null)
        {
            $dt = new DateTime(date("Y-m-d"));
            $start = $dt->getTimestamp();
            $StartTime = MysqlHelper::Timestamp2Mysql($start);
        }else{
            $start = MysqlHelper::Mysql2Timestamp($StartTime);
        }

        if($EndTime == null)
        {
            $end = $start + 24*3600;
            $EndTime = MysqlHelper::Timestamp2Mysql($end);
        }


        $uri = $this->mythbackenduri."/Guide/GetProgramGuide?StartTime=$StartTime&EndTime=$EndTime&StartChanId=$StartChanId&NumChannels=$NumChannels&Details=$Details";

        Yii::trace("[ServiceGuide::GetProgramGuide] uri: '$uri'");

        try{
            $response = \Httpful\Request::get($uri)->expectsXml()->send();
            if(!$dataprovider)
            {
                return $response->body;
            }else{
                function cmp($a, $b)
                {
                    return strcmp($a->StartTime, $b->StartTime);
                }

                $programList = array();
                foreach($response->body->Channels->ChannelInfo->Programs->Program as $p)
                {
                    $programList[] = $p;
                }
                usort($programList, 'cmp');

                $dataProvider=new CArrayDataProvider($programList, array(
                    'id'=>'false',
                    'pagination'=>false,
                ));
                return $dataProvider;
            }
        }catch (Exception $e){
            return false;
        }
    }


}

?>
