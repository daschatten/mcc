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
        $model = new MRecorded();
        $model->unsetAttributes(); // clear any default values
        $model->recgroup = ""; // set default recgroup to all

        if(isset($_GET['MRecorded']))
        {
            $model->attributes=$_GET['MRecorded'];
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

        $model = MRecorded::model()->findByPk($pk);

        if(! $model instanceof MRecorded)
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
            );
        }

        echo CJSON::encode($items);
        Yii::app()->end();
    }
}
