<?php
class StartupBehavior extends CBehavior{
    public function attach($owner){
        $owner->attachEventHandler('onBeginRequest', array($this, 'beginRequest'));
    }

    public function beginRequest(CEvent $event){
        $language=Yii::app()->request->getPreferredLanguage();
        Yii::app()->language=$language;
    }
}
?>
