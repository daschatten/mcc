<?php

class GuideController extends MController
{
    public function accessRules()
    {
        return array(
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
            'recstatus' => ((int) $detail->Recording->Status == 0) ? "" : MythtvEnum::getRecStatusString((int) $detail->Recording->Status),
            'recstatusclass' => MythtvEnum::getRecStatusClass((int) $detail->Recording->Status),
        );

        echo CJSON::encode($a);
        Yii::app()->end();
    }
}
