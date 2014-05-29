<?php

class RecordingsController extends MController
{
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('index', 'recordingInfo', 'recordingInfoFull'), 'roles' => array('o_recorded_view')),
            array('allow', 'actions' => array('upcoming'), 'roles' => array('o_upcoming_view')),
            array('allow', 'actions' => array('archive', 'addDownload', 'clearArchive'), 'roles' => array('o_archive_use')),
            array('deny', 'users' => array('*')),
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

    public function actionAddDownload($pk)
    {
        echo $pk;
        if(!Yii::app()->user->hasState('recordings.archive'))
        {
            Yii::app()->user->setState('recordings.archive', array());
        }

//        Yii::app()->user->setState('recordings.archive', array_push(Yii::app()->user->getState('recordings.archive'), $pk));

        $list = Yii::app()->user->getState('recordings.archive');
        $list[] = $pk;

        Yii::app()->user->setState('recordings.archive', $list);
    }

    public function actionArchive($method = null, $src = null, $dest = null)
    {
        $data = array();
        $isempty = false;
        $models = array();
        $errors = array();

        if(!Yii::app()->user->hasState('recordings.archive'))
        {
            $isempty = true;
            $list = array();
        }else{
            $list = Yii::app()->user->getState('recordings.archive');
        }

        foreach($list as $item)
        {
            // we have a composite key
            $values = explode(",", $item);
            $pk = array(
                array('chanid' => $values[0], 'starttime' => $values[1]),
            );

           $model = Recorded::model()->findByPk($pk); 

           if($model instanceof Recorded)
           {
                $models[] = $model;
           }else{
                $errors[] = $pk;
           }
        }

        $this->render("archive", array(
            'data' => array(
                'isempty' => $isempty,
                'models' => $models,
                'errors' => $errors,
                'method' => ($method == null) ? Yii::app()->params['archive.method'] : $method,
                'src' => ($src == null) ? Yii::app()->params['archive.source.path'] : $src,
                'dest' => ($dest == null) ? Yii::app()->params['archive.dest.path'] : $dest,
                ),
        ));
    }

    public function actionClearArchive()
    {
        Yii::app()->user->setState('recordings.archive', array());
        $this->actionArchive();
    }
}
