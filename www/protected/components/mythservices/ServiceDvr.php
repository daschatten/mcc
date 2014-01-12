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

}

?>
