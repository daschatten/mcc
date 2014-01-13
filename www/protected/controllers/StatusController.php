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

        $recgrouplist = Recorded::getRecgroups();

        $recgroupSummary = new CActiveDataProvider('Recorded', array(
                'pagination' => false,
                'criteria' => array(
                    'select' => 'recgroup, sum(filesize) as filesize, count(*) as episodeCount',
                    'group' => 'recgroup',
                ),
            ));

        $recgroupDataproviderList = array();

        foreach($recgrouplist as $recgroup)
        {
           $recgroupDataproviderList[$recgroup] = new CActiveDataProvider('Recorded', array(
                'pagination' => false,
                'criteria' => array(
                    'select' => 'title, sum(filesize) as filesize, count(*) as episodeCount',
                    'condition' => 'recgroup = :recgroup',
                    'params' => array(':recgroup' => $recgroup),
                    'group' => 'title',
                    'having' => 'count(*) > 1',
                ),
            ));
        }

        $this->render('storage', array(
            'storagegrouplist' => $storagegrouplist,
            'recgrouplist' => $recgrouplist,
            'recgroupDataproviderList' => $recgroupDataproviderList,
            'recgroupSummary' => $recgroupSummary,
            )
        );
    }
}
