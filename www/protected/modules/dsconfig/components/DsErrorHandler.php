<?php

class DsErrorHandler extends CErrorHandler
{
    public function handle($event)
    {
        $exception = $event->exception;

        $message = $exception->getMessage();

        if($exception instanceof CDbException)
        {
            Yii::app()->user->setFlash('error', 'Connection to database could not be established!');
            Yii::app()->request->redirect(Yii::app()->createUrl("dsconfig/dsDbConfig/check"));
        }elseif($exception instanceof DsConfigException){
            Yii::app()->request->redirect(Yii::app()->createUrl("dsconfig/dsConfig/check"));
        }else{
            Yii::app()->request->redirect(Yii::app()->createUrl("dsconfig/dsError/error", array('message' => $message)));
        }
    }
}

?>
