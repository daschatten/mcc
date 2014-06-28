<?php

require_once('protected/extensions/httpful/httpful.phar');

class MythService
{
    protected $mythbackenduri;

    public function __construct()
    {
        Yii::trace("[MythService] Setting 'mythbackenduri' to '".DsConfig::get('mythbackendUri')."'");
        $this->mythbackenduri = DsConfig::get('mythbackendUri');
    }

    public static function staticGet($uri, $type='Xml')
    {
        $uri = DsConfig::get('mythbackendUri').$uri;

        Yii::trace("[MythService::staticGet]".DsConfig::get('mythbackendUri')." uri: '$uri'");

        try{
            if($type == 'Json')
            {
                $response = \Httpful\Request::get($uri)->expectsJson()->send();
            }else{
                $response = \Httpful\Request::get($uri)->expectsXml()->send();
            } 
            return $response;
        }catch (Exception $e){
            Yii::trace("[MythService::staticGet] ERROR");
            throw $e;
        }
    }

    public static function test()
    {
        try{
            MythService::staticGet('/Dvr/GetUpcomingList?StartIndex=0&Count=10&ShowAll=false');
        }catch(Exception $e){
            $message = 'Connection to mythbackend failed!';
            Yii::trace($message);
            return Yii::t('app', $message);
        }

        return true;
    }
}

?>
