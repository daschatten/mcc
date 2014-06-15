<?php

/**
 * Avoid MController to bypass authentication and the following
 * CDbException because this would result in an CDbException loop.
 */

class DsDbConfigController extends CController
{
    // Avoid standard layout to bypass authentication and the following
    // CDbException because this would result in an CDbException loop.
    public $layout = 'application.modules.dsconfig.views.layouts.blank';

    public function actionCheck()
    {
        if(file_exists($this->module->dbLockFile))
        {
            $this->render('locked', array('file' => $this->module->dbLockFile));
            return;
        }
        $items = DsDbConfig::getItems(DsDbConfig::getFilename(), DsDbConfig::getVarName());

        if(file_exists($this->module->dbFile))
        {
            include($this->module->dbFile);
        }else{
            $db = array();
        }

        if(Yii::app()->request->requestType === 'POST')
        {
            $this->saveconfig($items);
            $this->redirect('check');
        }

        $testresult = $this->testConfig();

        $this->render('check', array(
            'items' => $items,
            'dbparams' => $db,
            'testresult' => $testresult,
        ));
    }

    private function saveConfig($items)
    {
        $params = array();
        $testdb = new CDbConnection();

        foreach($items as $key => $item)
        {
            if(isset($_POST[$key]))
            {
                $params[$key] = $_POST[$key];
                $testdb->$key = $_POST[$key];
            }
        }

        $filename = $this->module->dbFile;

        if(is_writable($filename))
        {
            if(file_put_contents($filename, '<?php $db = '.var_export($params, true).'; ?>') !== true)
            {
                Yii::app()->user->setFlash('success', Yii::t('dsconfigModule.app', 'Configuration saved!'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('dsconfigModule.app', 'Configuration could not be saved!'));
            }
        }else{
            Yii::app()->user->setFlash('error', Yii::t('dsconfigModule.app', 'Can\'t write configuration file \'{filename}\'. Please run \'extras/fixPermissions.sh\' to correct file permissions.', array('{filename}' => $filename)));
        }

        if($testdb->active = true)
        {
            if(!touch($this->module->dbLockFile))
            {
                Yii::app()->user->setFlash('error', Yii::t('dsconfigModule.app', 'File \'{filename}\' could not be written. You should create this file manually to prevent access to your database configuration.', array('{key}' => $key, '{file}' => $this->module->dbFile)));
            }
            
            Yii::app()->user->setFlash('success', Yii::t('dsconfigModule.app', 'Database connection successful!'));
            Yii::app()->request->redirect(Yii::app()->createUrl("site/index"));
            
        }
    }

    private function testConfig()
    {
        $testresult = DsDbConfig::test();

        foreach($testresult as $key => $data)
        {
            if($data !== null AND $data !== true)
            {
                Yii::app()->user->setFlash('error', Yii::t('dsconfigModule.app', 'Config item \'{key}\' generated an error: \'{message}\'', array('{key}' => $key, '{message}' => $data['message'])));
            }
        }
        return $testresult;
    }
}

?>
