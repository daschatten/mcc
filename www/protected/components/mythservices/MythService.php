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
}

?>
