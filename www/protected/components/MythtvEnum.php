<?php

abstract class MythtvEnum
{

    // http://code.mythtv.org/trac/browser/mythtv/mythtv/libs/libmythtv/tv.h
    const TV_ERROR                  = -1;
    const TV_NONE                   = 0;
    const TV_WATCHINGLIVETV         = 1;
    const TV_WATCHINGPRERECORDED    = 2;
    const TV_WATCHINGVIDEO          = 3;
    const TV_WATCHINGDVD            = 4;
    const TV_WATCHINGBD             = 5;
    const TV_WATCHINGRECORDING      = 6;
    const TV_RECORDINGONLY          = 7;

    public static function getTvString($num)
    {
        switch ($num)
        {
            case -1:
                return Yii::t('app', 'Error');
            case 0:
                return Yii::t('app', 'Idle');
            case 1:
                return Yii::t('app', 'Watching live tv');
            case 2:
                return Yii::t('app', 'Watching prerecorded');
            case 3:
                return Yii::t('app', 'Watching video');
            case 4:
                return Yii::t('app', 'Watching dvd');
            case 5:
                return Yii::t('app', 'Watching Blueray');
            case 6:
                return Yii::t('app', 'Watching recording');
            case 7:
                return Yii::t('app', 'Recording');
            default:
                return Yii::t('app', 'Unknown');
        }
    }
}

?>
