<?php

class GuideController extends CController
{
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

            $programCriteria->params = array(
                ':daystart' => date('Y-m-d', $daystart),
                ':dayend' => date('Y-m-d', $dayend),
                ':chanid' => $channel->chanid,
            );

            $program = Program::model()->findAll($programCriteria);
            $programlist[] = $program;
        }
 
        $this->render('daymultiview', array('programlist' => $programlist));
    }
}
