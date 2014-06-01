<?php

require_once('protected/extensions/httpful/httpful.phar');

class MythService
{
    protected $mythbackenduri;

    public function __construct()
    {
        Yii::trace("[MythService] Setting 'mythbackenduri' to '".Config::get('mythbackendUri')."'");
        $this->mythbackenduri = Config::get('mythbackendUri');
    }

    public static function staticGet($uri, $type='Xml')
    {
        $uri = Config::get('mythbackendUri').$uri;

        Yii::trace("[MythService::staticGet]".Config::get('mythbackendUri')." uri: '$uri'");

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
