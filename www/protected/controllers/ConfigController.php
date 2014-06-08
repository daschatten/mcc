<?php

class ConfigController extends MController
{
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('*'), 'users' => array('*')),
        );
    }


    public function actionCheck()
    {
        $items = Config::getItems();
        $params = Yii::app()->params;

        $this->render('check', array(
            'items' => $items,
            'params' => $params,
        ));
    }

}

?>
