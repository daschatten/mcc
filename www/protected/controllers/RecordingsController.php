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
}
