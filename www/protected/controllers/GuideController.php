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

    public function actionRecord($template)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "title = :title";
        $criteria->params = array(
            ':title' => $template,
        );

        $model = Record::model()->find($criteria);

        if(!$model instanceof Record)
        {
            echo "false r";
            return;
        }

        // fix starttime value for mysql
        $st = str_replace("T", " ", Yii::app()->user->getState("rec.starttime"));
        $st = str_replace("Z", " ", $st);

        // get program model for recording details
        $criteria = new CDbCriteria();
        $criteria->condition = "chanid = :chanid AND starttime = :starttime";
        $criteria->params = array(
            ':chanid' => Yii::app()->user->getState("rec.chanid"),
            ':starttime' => $st,
        );

        $program = Program::model()->find($criteria);

        if(!$program instanceof Program)
        {
            echo "false p";
            return;
        }


        // we use the model as start for our new rule
//        $model->recordid = null;
/*        $model->title = Yii::app()->user->getState("rec.title");
        $model->starttime = date('H:i:s', strtotime(Yii::app()->user->getState("rec.starttime")));
        $model->startdate = date('Y-m-d', strtotime(Yii::app()->user->getState("rec.starttime")));
        $model->endtime = date('H:i:s', strtotime(Yii::app()->user->getState("rec.endtime")));
        $model->enddate = date('Y-m-d', strtotime(Yii::app()->user->getState("rec.endtime")));
        $model->chanid = Yii::app()->user->getState("rec.chanid");
        // findid calculation: http://www.mythtv.org/wiki/Record_table
        // (UNIX_TIMESTAMP(program.starttime)/60/60/24)+719528 
*/

        $model->recordid = null;
        $model->setIsNewRecord(true);

        $model->type = 1;
        $model->title = $program->title;
        $model->starttime = $program->starttime;
        $model->starttime = date('H:i:s', strtotime(Yii::app()->user->getState("rec.starttime")) - 3600);
        $model->startdate = date('Y-m-d', strtotime(Yii::app()->user->getState("rec.starttime")) - 3600);
        $model->endtime = date('H:i:s', strtotime(Yii::app()->user->getState("rec.endtime")) - 3600);
        $model->enddate = date('Y-m-d', strtotime(Yii::app()->user->getState("rec.endtime")) - 3600);
        $model->chanid = $program->chanid; 
        $model->subtitle = $program->subtitle;
        $model->description = $program->description;
        $model->station = $program->channel->callsign;
        $model->seriesid = $program->seriesid;
        $model->programid = $program->programid;

        $model->findid = (int) (strtotime(Yii::app()->user->getState("rec.starttime")) / 60 / 60 /24) + 719528 + 1;
        $model->findday = (date('w', strtotime(Yii::app()->user->getState("rec.starttime"))) + 1) % 7;
        $model->findtime = date('H:i:s', strtotime(Yii::app()->user->getState("rec.starttime")));
        $model->inactive = 1;

        if(!$model->save())
        {
            echo "save failed";
            print_r($model);
            print_r( $model->getErrors());
            return;
        }

        $dvr = new ServiceDvr();
        if($dvr->EnableRecordSchedule($model->recordid))
        {
            echo "OK";
        }else{
            echo "Failed";
        }


        $dvr = new ServiceDvr();
        $rule = $dvr->GetRecordSchedule($model->recordid);
/*      
        $rule->RecRule->Id = null;
        $rule->RecRule->Type = 'single';
        $rule->RecRule->Title = CHtml::encode(Yii::app()->user->getState("rec.title"));
        $rule->RecRule->StartTime = Yii::app()->user->getState("rec.starttime");
        $rule->RecRule->EndTime = Yii::app()->user->getState("rec.endtime");
        $rule->RecRule->ChanId = $program->chanid; 
        $rule->RecRule->SubTitle = CHtml::encode($program->subtitle);
        $rule->RecRule->Description = CHtml::encode($program->description);
        $rule->RecRule->CallSign = CHtml::encode($program->channel->callsign);
        $rule->RecRule->SeriesId = $program->seriesid;
        $rule->RecRule->ProgramId = $program->programid;
        $rule->RecRule->FindId = (int) (strtotime(Yii::app()->user->getState("rec.starttime")) / 60 / 60 /24) + 719528;
        $rule->RecRule->FindDay = (date('w', strtotime(Yii::app()->user->getState("rec.starttime"))) + 1) % 7;
        $rule->RecRule->FindTime = date('H:i:s', strtotime(Yii::app()->user->getState("rec.starttime")));


        $result = $dvr->AddRecordSchedule($rule);
        */
    }


}
