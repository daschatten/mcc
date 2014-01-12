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

        $capturecardlist = new CActiveDataProvider('Capturecard', array(
            'pagination' => false,
            'criteria' => array(
                'order' => 'cardid ASC',
            ),
        ));
        $cardinputlist = new CActiveDataProvider('Cardinput', array(
            'pagination' => false,
            'criteria' => array(
                'order' => 'cardinputid ASC',
            ),
        ));
        $videosourcelist = new CActiveDataProvider('Videosource', array(
            'pagination' => false,
            'criteria' => array(
                'order' => 'sourceid ASC',
            ),
        ));

        $this->render('tuner', array(
            'encoderlist' => $encoderlist,
            'capturecardlist' => $capturecardlist,
            'cardinputlist' => $cardinputlist,
            'videosourcelist' => $videosourcelist,
            )
        );
    }

    public function actionStorage()
    {
        $storagegrouplist = new CActiveDataProvider('Storagegroup', array(
            'pagination' => false,
            'criteria' => array(
                'order' => 'groupname ASC',
            ),
        ));

        $recgrouplist = array();

         $this->render('storage', array(
            'storagegrouplist' => $storagegrouplist,
            'recgrouplist' => $recgrouplist,
            )
        );
    }
}
