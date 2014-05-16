<?php

class GuideController extends MController
{
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('record'), 'roles' => array('recording_add')),
            array('deny', 'actions' => array('record'), 'users' => array('*')),
            array('deny', 'users' => array('?')),
        );
    }

    public function actionIndex()
    {
        $this->actionDaymultiview();
    }

    public function actionDaymultiview($channum = null, $daystart = null)
    {
        if($channum == null)
        {
            $startchannelCriteria = new CDbCriteria();
            $startchannelCriteria->condition = "visible = :visible";
            $startchannelCriteria->order = "1*channum ASC";
            $startchannelCriteria->params = array(':visible' => 1);
            $startchannelCriteria->limit = 1;

            $startchan = Channel::model()->find($startchannelCriteria);
            $channum = $startchan->channum;
        }

        $channelCriteria = new CDbCriteria();
        $channelCriteria->condition = "visible = :visible AND 1*channum >= :channum";
        $channelCriteria->order = "1*channum ASC";
        $channelCriteria->params = array(':visible' => 1, ':channum' => $channum);
        $channelCriteria->limit = 5;

        $channellist = Channel::model()->findAll($channelCriteria);

        $programlist = array();

        foreach($channellist as $channel)
        {
            // calculate timestampf to display todays program
            $daystart = strtotime(date('Y-m-d'));
            $dayend = $daystart + 3600*24;

            $guide = new ServiceGuide();
            $program = $guide->GetProgramGuide(false, date('Y-m-d H:i:s', $daystart), date('Y-m-d H:i:s', $dayend), $channel->chanid, 1, true);
            $programlist[] = $program;
        }

        $searchModel = new GuideSearchModel();

        if(isset($_GET['channum']))
        {
            $searchModel->channum = $_GET['channum'];
        }
        

        $this->render('daymultiview', array(
            'programlist' => $programlist,
            'searchModel' => $searchModel,
        ));
    }

    public function actionWeeksingleview($channum = null, $daystart = null)
    {
        if($channum == null)
        {
            $startchannelCriteria = new CDbCriteria();
            $startchannelCriteria->condition = "visible = :visible";
            $startchannelCriteria->order = "1*channum ASC";
            $startchannelCriteria->params = array(':visible' => 1);

            $startchan = Channel::model()->find($startchannelCriteria);
            $channum = $startchan->channum;
        }

        $channelCriteria = new CDbCriteria();
        $channelCriteria->condition = "visible = :visible AND 1*channum >= :channum";
        $channelCriteria->order = "1*channum ASC";
        $channelCriteria->params = array(':visible' => 1, ':channum' => $channum);

        $channel = Channel::model()->find($channelCriteria);

        $daystart = strtotime(date('Y-m-d'));
        $dayend = $daystart + 14 * 3600*24;

        $guide = new ServiceGuide();
        $programlist = $guide->GetProgramGuide(false, date('Y-m-d H:i:s', $daystart), date('Y-m-d H:i:s', $dayend), $channel->chanid, 1, true);

        $searchModel = new GuideSearchModel();

        if(isset($_GET['channum']))
        {
            $searchModel->channum = $_GET['channum'];
        }

        $items = array();

        foreach($programlist->ProgramGuide->Channels[0]->Programs as $p)
        {
            $items[] = array(
                'title' => "$p->Title",
                'start' => "$p->StartTime",
                'end' => "$p->EndTime",
                'allDay' => false,
                'description' => "$p->Description" ,
                'channel' => (string) $programlist->ProgramGuide->Channels[0]->ChannelName,
                'chanid' => (int) $programlist->ProgramGuide->Channels[0]->ChanId,
                'starttime' =>  "$p->StartTime",
            );
        }
       

        $this->render('weeksingleview', array(
            'items' => $items,
            'searchModel' => $searchModel,
            'channelName' => $channel->name,
        ));
    }

    public function actionWeeksingleview2($channum = null, $daystart = null)
    {
        if($channum == null)
        {
            $startchannelCriteria = new CDbCriteria();
            $startchannelCriteria->condition = "visible = :visible";
            $startchannelCriteria->order = "1*channum ASC";
            $startchannelCriteria->params = array(':visible' => 1);

            $startchan = Channel::model()->find($startchannelCriteria);
            $channum = $startchan->channum;
        }

        $channelCriteria = new CDbCriteria();
        $channelCriteria->condition = "visible = :visible AND 1*channum >= :channum";
        $channelCriteria->order = "1*channum ASC";
        $channelCriteria->params = array(':visible' => 1, ':channum' => $channum);

        $channel = Channel::model()->find($channelCriteria);

        // get guide from today on
        $daystart = strtotime(date('Y-m-d'));
        // add time offset because mythtv treats given time as utc
        $guidestart = $daystart + Yii::app()->params['utcoffset'];
        $guideend = $guidestart + Yii::app()->params['utcoffset'] + 7 * 3600*24;
        // get guide for seven days
        $dayend = $daystart + 7 * 3600*24;

        $guide = new ServiceGuide();
        $programlist = $guide->GetProgramGuide(false, date('Y-m-d H:i:s', $guidestart), date('Y-m-d H:i:s', $guideend), $channel->chanid, 1, true);

        $searchModel = new GuideSearchModel();

        if(isset($_GET['channum']))
        {
            $searchModel->channum = $_GET['channum'];
        }

        $this->render('weeksingleview2', array(
            'programlist' => $programlist,
            'searchModel' => $searchModel,
            'channel' => $channel,
            'periodstart' => $daystart,
            'periodend' => $dayend,
        ));
    }

    /**
     *  Creates a guide for a single channel for a variable number of days.
     *  Params:
     *      $channum:   Channel number
     *      start:      Startdate in format 'Y-m-d'
     *      $daycount:  Number of days to display
     *      $partcount: Number of dayparts to display
     */
    public function actionWeeksingleview3($channum = null, $start = null, $daycount = 7, $partcount = 3)
    {
        // get timezone offset for date calculations because mythtv treats given time as utc
        $tzoffset = timezone_offset_get(new DateTimeZone(Yii::app()->params['timezone']), new DateTime(null, new DateTimeZone('UTC')));

        // fetch channel which should be displayed
        if($channum == null)
        {
            $startchannelCriteria = new CDbCriteria();
            $startchannelCriteria->condition = "visible = :visible";
            $startchannelCriteria->order = "1*channum ASC";
            $startchannelCriteria->params = array(':visible' => 1);

            $startchan = Channel::model()->find($startchannelCriteria);
            $channum = $startchan->channum;
        }

        $channelCriteria = new CDbCriteria();
        $channelCriteria->condition = "visible = :visible AND 1*channum >= :channum";
        $channelCriteria->order = "1*channum ASC";
        $channelCriteria->params = array(':visible' => 1, ':channum' => $channum);

        $channel = Channel::model()->find($channelCriteria);

        // create start end end dates for guide
        // these dates are for the first day only
        // further calculations are made below
        if($start == null)
        {
            $startdate = strtotime(date('Y-m-d'));
        }else{
            $startdate = strtotime($start);
        }

        // add time offset because mythtv treats given time as utc
        $startdate = $startdate - $tzoffset;

        // caluculate day parts length in seconds
        $partlength = round(24 / $partcount) * 3600;

        // fetch guide data
        $programlist = array();
        $guide = new ServiceGuide();

        // loop over all days
        for($i=0;$i<$daycount;$i++)
        {
            $partlist = array();
            // to get the correct date we have to add the previous subtracted tzoffset, if not we get all dates off by one
            $partlist['day'] = date('Y-m-d', $startdate + $i * 24 * 3600 + $tzoffset); 
            $partlist['data'] = array();

            // loop over all day parts
            for($j=0;$j<$partcount;$j++)
            { 
                // add 1 second to avoid programs which end at start of period, e.g. 00:00
                $guidestart = date('Y-m-d H:i:s', $startdate + 1 + $i * 24 * 3600 + $j * $partlength);
                // subtract 1 second to avoid programs which start at next period, e.g. 00:00
                $guideend = date('Y-m-d H:i:s', $startdate - 1 + $i * 24 * 3600 + $j * $partlength + $partlength);
                $part = array();
                $part['start'] = $guidestart;
                $part['end'] = $guideend;
                $part['data'] = $guide->GetProgramGuide(false, $guidestart, $guideend, $channel->chanid, 1, true);
                $partlist['data'][] = $part;
            }
            $programlist[] = $partlist;
        }

        // set search model
        $searchModel = new GuideSearchModel();

        // check if a search is already in progress and modify new model according to it
        if(isset($_GET['channum']))
        {
            $searchModel->channum = $_GET['channum'];
        }

        // render view
        $this->render('weeksingleview3', array(
            'data' => array(
                'programlist' => $programlist,
                'searchModel' => $searchModel,
                'channel' => $channel,
                'startdate' => $startdate,
                'daycount' => $daycount,
                'partcount' => $partcount,
                'partlength' => $partlength,
                ),
        ));
    }

    public function actionDetail($chanid, $starttime)
    {
        $guide = new ServiceGuide();
        $detail = $guide->GetProgramDetails(false, $starttime, $chanid);

        $a = array(
            'channel' => (string) $detail->Channel->ChannelName,
            'chanid' => (int) $detail->Channel->ChanId,
            'title' => (string) $detail->Title,
            'subtitle' => (string) $detail->SubTitle,
            'description' => (string) $detail->Description,
            'starttime' => (string) $detail->StartTime,
            'endtime' => (string) $detail->EndTime,
            'starttimeloc' => Yii::app()->dateFormatter->formatDateTime((string) $detail->StartTime, 'short', 'short'),
            'endtimeloc' => Yii::app()->dateFormatter->formatDateTime((string) $detail->EndTime, 'short', 'short'),
            'recstatus' => ((int) $detail->Recording->Status == 0) ? "" : MythtvEnum::getRecStatusString((int) $detail->Recording->Status),
            'recstatusclass' => MythtvEnum::getRecStatusClass((int) $detail->Recording->Status),
        );

        // save selection for easier use of recording buttons
        Yii::app()->user->setState("rec.title",(string) $detail->Title);
        Yii::app()->user->setState("rec.starttime",(string) $detail->StartTime);
        Yii::app()->user->setState("rec.endtime",(string) $detail->EndTime);
        Yii::app()->user->setState("rec.chanid",(string) $detail->Channel->ChanId);

        echo CJSON::encode($a);
        Yii::app()->end();
    }

    public function actionRecord($template, $type = 1)
    {

        // fix starttime value for mysql
        $st = str_replace("T", " ", Yii::app()->user->getState("rec.starttime"));
        $st = str_replace("Z", " ", $st);

        $chanid = Yii::app()->user->getState("rec.chanid");

        // get program model for recording details
        $criteria = new CDbCriteria();
        $criteria->condition = "chanid = :chanid AND starttime = :starttime";
        $criteria->params = array(
            ':chanid' => $chanid,
            ':starttime' => $st,
        );

        $program = Program::model()->find($criteria);

        if(!$program instanceof Program)
        {
            echo "No program model found with search attributes: chanid = '$chanid' and starttime = '$st'";
            return;
        }

        try{
            $program->record($template, $type);
        }catch(Exception $e){
            echo $e->getMessage();
        }

        echo "true";
    }


}
