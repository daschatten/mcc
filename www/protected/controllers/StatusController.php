<?php

class StatusController extends MController
{
    public function accessRules()
    {
        return array(
            array('deny', 'users' => array('?')),
        );
    }

	public function actionIndex()
	{
        $this->actionBackend();
    }

    public function actionBackend()
    {
        $this->render('backend');
    }

	public function actionTuner()
	{
        $dvr = new ServiceDvr();
        $encoderlist = $dvr->GetEncoderList(true);

        $this->render('tuner', array('dataProvider' => $encoderlist));
    }

    public function actionStorage()
    {
        $this->render('storage');
    }
}
