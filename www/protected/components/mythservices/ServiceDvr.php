<?php

class ServiceDvr extends MythService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetUpcomingList($dataprovider=false,$StartIndex=0,$Count=15,$ShowAll='false')
    {
        $uri = $this->mythbackenduri."/Dvr/GetUpcomingList?StartIndex=$StartIndex&Count=$Count&ShowAll=$ShowAll";

        Yii::trace("[ServiceDvr::GetUpcomingList] uri: '$uri'");

        try{
            $response = \Httpful\Request::get($uri)->expectsXml()->send();
            if(!$dataprovider)
            {
                return $response->body;
            }else{
                $dataProvider=new CArrayDataProvider($response->body->Programs->Program, array(
                    'pagination'=>false,
                ));
                return $dataProvider;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function GetEncoderList($dataprovider=false)
    {
        $uri = $this->mythbackenduri."/Dvr/GetEncoderList";

        Yii::trace("[ServiceDvr::GetEncoderList] uri: '$uri'");



        try{
            $response = \Httpful\Request::get($uri)->addHeader('Accept', 'application/json')->send();
            if(!$dataprovider)
            {
                return $response->body;
            }else{
                $dataProvider=new CArrayDataProvider($response->body->EncoderList->Encoders, array(
                    'keyField'=>'Id',
                    'pagination'=>false,
                ));
                return $dataProvider;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function GetRecordSchedule($recordId)
    {
        $uri = $this->mythbackenduri."/Dvr/GetRecordSchedule?RecordId=$recordId";

        Yii::trace("[ServiceDvr::GetRecordSchedule] uri: '$uri'");

        try{
            $response = \Httpful\Request::get($uri)->addHeader('Accept', 'application/json')->send();
            return $response->body;
            
        }catch (Exception $e){
            return false;
        }
    }

    public function AddRecordSchedule($json)
    {
        $uri = $this->mythbackenduri."/Dvr/AddRecordSchedule";

        Yii::trace("[ServiceDvr::AddRecordSchedule] uri: '$uri'");

        try{
            $response = \Httpful\Request::post($uri)->sendsJson()->addHeader('Accept', 'application/json')->body($json)->send();
            return $response->body;
            
        }catch (Exception $e){
            return false;
        }
    }

    public function EnableRecordSchedule($recordid)
    {
        $uri = $this->mythbackenduri."/Dvr/EnableRecordSchedule?RecordId=$recordid";

        Yii::trace("[ServiceDvr::EnableRecordSchedule] uri: '$uri'");

        try{
            $response = \Httpful\Request::get($uri)->addHeader('Accept', 'application/json')->send();
            return $response->body;
            
        }catch (Exception $e){
            return false;
        }

    }
}

?>
