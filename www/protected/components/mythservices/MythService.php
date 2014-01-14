<?php

require_once('protected/extensions/httpful/httpful.phar');

class MythService
{
    protected $mythbackenduri;

    public function __construct()
    {
        Yii::trace("[MythService] Setting 'mythbackenduri' to '".Yii::app()->params['mythbackendUri']."'");
        $this->mythbackenduri = Yii::app()->params['mythbackendUri'];
    }

    public static function staticGet($uri, $type='Xml')
    {
        $uri = Yii::app()->params['mythbackendUri'].$uri;

        Yii::trace("[MythService::staticGet]".Yii::app()->params['mthbackendUri']." uri: '$uri'");

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
            echo "ERROR: ".$e;
            return false;
        }
       
    }
}

?>
