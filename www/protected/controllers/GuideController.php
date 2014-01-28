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

    public function actionDaymultiview()
    {
        $channelCriteria = new CDbCriteria();
        $channelCriteria->condition = "visible = :visible";
        $channelCriteria->order = "1*channum ASC";
        $channelCriteria->params = array(':visible' => 1);
        $channelCriteria->limit = 5;

        $channellist = Channel::model()->findAll($channelCriteria);

        $programCriteria = new CDbCriteria();
        $programCriteria->condition = "starttime < :dayend AND endtime >= :daystart AND chanid = :chanid";
        $programCriteria->order = "starttime ASC";

        $programlist = array();

        foreach($channellist as $channel)
        {
            // calculate timestampf to display todays program
            $daystart = strtotime(date('Y-m-d'));
            $dayend = $daystart + 3600*24;

            /*
            $programCriteria->params = array(
                ':daystart' => date('Y-m-d', $daystart),
                ':dayend' => date('Y-m-d', $dayend),
                ':chanid' => $channel->chanid,
            );

            $program = Program::model()->findAll($programCriteria);
            */
            $guide = new ServiceGuide();
            $program = $guide->GetProgramGuide(false, date('Y-m-d H:i:s', $daystart), date('Y-m-d H:i:s', $dayend), $channel->chanid, 1, true);
            $programlist[] = $program;
        }
 
        $this->render('daymultiview', array('programlist' => $programlist));
    }

    public function actionDetail($chanid, $starttime)
    {
        /*
        $criteria = new CDbCriteria();
        $criteria->condition = "chanid = :chanid AND starttime = :starttime";
        $criteria->params = array(
            ':chanid' => $chanid,
            ':starttime' => $starttime,
        );

        $model = Program::model()->find($criteria);

        if(!$model instanceof Program)
        {
            echo "false";
            return;
        }
        */

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
        );

        echo CJSON::encode($a);
        Yii::app()->end();
    }
}
