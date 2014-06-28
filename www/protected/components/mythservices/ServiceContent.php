<?php

class ServiceContent extends MythService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetPreviewImage($returnurl = false, $ChanId, $StartTime, $Width = null, $Height = null, $SecsIn = null)
    {
        $uri = $this->mythbackenduri."/Content/GetPreviewImage?ChanId=$ChanId&StartTime=$StartTime";

        if($Width !== null)
            $uri = $uri."&Width=$Width";
        if($Height !== null)
            $uri = $uri."&Height=$Height";
        if($SecsIn !== null)
            $uri = $uri."&SecsIn=$SecsIn";

        Yii::trace("[Servicecontent::GetPreviewImage] uri: '$uri'");

        if($returnurl)
        {
            return $uri;
        }

        try{
            $response = \Httpful\Request::get($uri)->send();

            return $response->body;
        }catch (Exception $e){
            return false;
        }
    }

}

?>
