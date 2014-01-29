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

    // http://code.mythtv.org/trac/browser/mythtv/mythtv/libs/libmyth/programtypes.h
    const rsOtherRecording = -13;
    const rsOtherTuning = -12;
    const rsMissedFuture = -11;
    const rsTuning = -10;
    const rsFailed = -9;
    const rsTunerBusy = -8;
    const rsLowDiskSpace = -7;
    const rsCancelled = -6;
    const rsMissed = -5;
    const rsAborted = -4;
    const rsRecorded = -3;
    const rsRecording = -2;
    const rsWillRecord = -1;
    const rsUnknown = 0;
    const rsDontRecord = 1;
    const rsPreviousRecording = 2;
    const rsCurrentRecording = 3;
    const rsEarlierShowing = 4;
    const rsTooManyRecordings = 5;
    const rsNotListed = 6;
    const rsConflict = 7;
    const rsLaterShowing = 8;
    const rsRepeat = 9;
    const rsInactive = 10;
    const rsNeverRecord = 11;
    const rsOffLine = 12;
    const rsOtherShowing = 13;

    public static function getRecStatusString($num)
    {
        switch($num)
        {
            case -13:
                return Yii::t('app', 'Other recording');
            case -12:
                return Yii::t('app', 'Other tuning');
            case -11:
                return Yii::t('app', 'Missed future');
            case -10:
                return Yii::t('app', 'Tuning');
            case -9:
                return Yii::t('app', 'Failed');
            case -8:
                return Yii::t('app', 'Tuner busy');
            case -7:
                return Yii::t('app', 'Low disk space');
            case -6:
                return Yii::t('app', 'Cancelled');
            case -5:
                return Yii::t('app', 'Missed');
            case -4:
                return Yii::t('app', 'Aborted');
            case -3:
                return Yii::t('app', 'Recorded');
            case -2:
                return Yii::t('app', 'Recording');
            case -1:
                return Yii::t('app', 'Will record');
            case -0:
                return Yii::t('app', 'Unknown');
            case 1:
                return Yii::t('app', 'Don\'t record');
            case 2:
                return Yii::t('app', 'Previous recording');
            case 3:
                return Yii::t('app', 'Current recording');
            case 4:
                return Yii::t('app', 'Earlier recording');
            case 5:
                return Yii::t('app', 'Too many recordings');
            case 6:
                return Yii::t('app', 'Not listed');
            case 7:
                return Yii::t('app', 'Conflict');
            case 8:
                return Yii::t('app', 'Later showing');
            case 9:
                return Yii::t('app', 'Repeat');
            case 10:
                return Yii::t('app', 'Inactive');
            case 11:
                return Yii::t('app', 'Never record');
            case 12:
                return Yii::t('app', 'Offline');
            case 13:
                return Yii::t('app', 'Other showing');
        }
    }

    public static function getRecStatusClass($num)
    {
        switch($num)
        {
            case -13:
                return 'rs-other-recording';
            case -12:
                return 'rs-other-tuning';
            case -11:
                return 'rs-missed-future';
            case -10:
                return 'rs-tuning';
            case -9:
                return 'rs-failed';
            case -8:
                return 'rs-tuner-busy';
            case -7:
                return 'rs-low-disk-space';
            case -6:
                return 'rs-cancelled';
            case -5:
                return 'rs-missed';
            case -4:
                return 'rs-aborted';
            case -3:
                return 'rs-recorded';
            case -2:
                return 'rs-recording';
            case -1:
                return 'rs-will-record';
            case -0:
                return 'rs-unknown';
            case 1:
                return 'rs-dont-record';
            case 2:
                return 'rs-previous-recording';
            case 3:
                return 'rs-current-recording';
            case 4:
                return 'rs-earlier-recording';
            case 5:
                return 'rs-too-many-recordings';
            case 6:
                return 'rs-not-listed';
            case 7:
                return 'rs-conflict';
            case 8:
                return 'rs-later-showing';
            case 9:
                return 'rs-repeat';
            case 10:
                return 'rs-inactive';
            case 11:
                return 'rs-never-record';
            case 12:
                return 'rs-offline';
            case 13:
                return 'rs-other-showing';
        }
    }
}

?>
