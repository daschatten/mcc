<?php

class RecordingsController extends MController
{
    public function accessRules()
    {
        return array(
            array('deny', 'users' => array('?')),
        );
    }

	public function actionIndex()
	{
        $model = new Recorded();
        $model->unsetAttributes(); // clear any default values
        $model->recgroup = ""; // set default recgroup to all

        if(isset($_GET['Recorded']))
        {
            $model->attributes = $_GET['Recorded'];
            Yii::app()->user->setState('recordings.list.filter', $_GET['Recorded']);
        }elseif(Yii::app()->user->hasState('recordings.list.filter')){
            $model->attributes = Yii::app()->user->getState('recordings.list.filter');
        }

		$this->render('index', array('recorded' => $model));
	}

    public function actionRecordingInfo($id)
    {
         // we have a composite key
        $values = explode(",", $id);
        $pk = array(
            array('chanid' => $values[0], 'starttime' => $values[1]),
        );

       if(isset($_POST['ajax']))
        {
            $this->actionRecordingInfoAjax($pk);
        }else{
            $this->actionRecordingInfoFull($pk);
        }
    }

    public function actionRecordingInfoFull($pk)
    {

        $model = Recorded::model()->findByPk($pk);

        if(! $model instanceof Recorded)
        {    
            throw new CHttpException(404,'The specified recording cannot be found.');
        }

        $this->render('_recordingDetail', array('model' => $model));
    }

    public function actionRecordingInfoAjax($pk)
    {

        $model = Recorded::model()->findByPk($pk);

        if(! $model instanceof Recorded)
        {
            echo "false";
        }

        echo CJSON::encode(array(
            'title' => $model->title,
            'subtitle' => $model->subtitle,
            'description' => $model->description,
            'starttime' => $model->starttime,
            'endtime' => $model->endtime,
            'length' => $model->length,
            'episodeString' => $model->episodeString,
            'recgroup' => $model->recgroup,
            'basename' => $model->basename,
            'watched' => $model->watched,
            'season' => $model->season,
            'episode' => $model->episode,
            'stars' => $model->stars,
            'filesize' => $model->filesizeGb,
        ));
    }

    public function actionUpcoming()
    {
        $s = new ServiceDvr();
        $dp = $s->GetUpcomingList(true);
        $this->render('upcoming', array('dataProvider' => $dp));
    }

    public function actionUpcomingFeed()
    {
        $s = new ServiceDvr();
        $data = $s->GetUpcomingList(false, 0, 300, false);

        $items = array();

        foreach($data->Programs->Program as $p)
        {
            $items[] = array(
                'title' => "$p->Title",
                'start' => "$p->StartTime",
                'end' => "$p->EndTime",
                'allDay' => false,
                'description' => "$p->Description" ,
                'channel' => (string) $p->Channel->ChannelName,
            );
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }
}
