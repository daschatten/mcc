<?php

class GuideController extends MController
{
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('view', 'detail', 'activeTab'), 'roles' => array('o_guide_view')),
            array('allow', 'actions' => array('record'), 'roles' => array('o_record_rule_add')),
            array('allow', 'actions' => array('delRecord'), 'roles' => array('o_record_rule_del')),
            array('deny', 'users' => array('*')),
        );
    }

    public function actionIndex()
    {
        $this->actionView();
    }

    /**
     *  Creates a guide for a single channel for a variable number of days.
     *  Params:
     *      $channum:   Channel number
     *      start:      Startdate as unix timestamp
     *      $daycount:  Number of days to display
     *      $partcount: Number of dayparts to display
     */
    public function actionView($channum = null, $start = null, $daycount = 7, $partcount = 3)
    {
        // get timezone offset for date calculations because mythtv treats given time as utc
        
        $tzoffset = timezone_offset_get(new DateTimeZone(DsConfig::get('timezone')), new DateTime(null, new DateTimeZone('UTC')));

        // fetch channel which should be displayed
        if($channum == null or $channum == '')
        {
            // check wether a state entry for method parameters exists
            if(Yii::app()->user->hasState('guide.channum'))
            {
                $channum = Yii::app()->user->getState('guide.channum');
            }else{
                $startchannelCriteria = new CDbCriteria();
                $startchannelCriteria->condition = "visible = :visible";
                $startchannelCriteria->order = "1*channum ASC";
                $startchannelCriteria->params = array(':visible' => 1);

                $startchan = Channel::model()->find($startchannelCriteria);
                $channum = $startchan->channum;
            }
        }
                
        Yii::app()->user->setState('guide.channum', $channum);

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
            if(Yii::app()->user->hasState('guide.start'))
            {
                $start = Yii::app()->user->getState('guide.start');
            }else{
                $start = time();
            }
        }
       
        Yii::app()->user->setState('guide.start', $start);

        $startdate = strtotime(date('Y-m-d', $start));

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
                $guidestart = date('Y-m-d H:i:s', $startdate + 1 + $i * 24 * 3600 + $j * $partlength - $tzoffset);
                // subtract 1 second to avoid programs which start at next period, e.g. 00:00
                $guideend = date('Y-m-d H:i:s', $startdate - 1 + $i * 24 * 3600 + $j * $partlength + $partlength - $tzoffset);
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

        $searchModel->channum = $channum;

        // render view
        $this->render('view', array(
            'data' => array(
                'programlist' => $programlist,
                'searchModel' => $searchModel,
                'channel' => $channel,
                'startdate' => $startdate,
                'daycount' => $daycount,
                'partcount' => $partcount,
                'partlength' => $partlength,
                'start' => $start,
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
            'endtimeloc' => Yii::app()->dateFormatter->formatDateTime((string) $detail->EndTime, null, 'short'),
            'recstatus' => ((int) $detail->Recording->Status == 0) ? "" : MythtvEnum::getRecStatusString((int) $detail->Recording->Status),
            'recstatusraw' => (int) $detail->Recording->Status,
            'recstatusclass' => MythtvEnum::getRecStatusClass((int) $detail->Recording->Status),
            'recruleid' => (int) $detail->Recording->RecordId,
        );

        // save selection for easier use of recording buttons
        Yii::app()->user->setState("rec.title",(string) $detail->Title);
        Yii::app()->user->setState("rec.starttime",(string) $detail->StartTime);
        Yii::app()->user->setState("rec.endtime",(string) $detail->EndTime);
        Yii::app()->user->setState("rec.chanid",(string) $detail->Channel->ChanId);

        $this->render('view/detail', array('data' => $a));
    }

    public function actionActivetab($tabid)
    {
        if($tabid !== 'undefined')
        {
            Yii::app()->user->setState('guide.tab.selected', $tabid);
        }
    }

    public function actionDelRecord($ruleid)
    {
        $dvr = new ServiceDvr();
        $dvr->RemoveRecordSchedule($ruleid);
        
        return "true";

        # $this->actionDetail(Yii::app()->user->getState("rec.chanid"), Yii::app()->user->getState("rec.starttime"));
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
