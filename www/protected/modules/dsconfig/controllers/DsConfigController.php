<?php

class DsConfigController extends CController
{
    public function filters()
    {
        if(isset($this->module->useYiiAuth) && $this->module->useYiiAuth)
        {
            return array(
                'accessControl',
            );
        }else{
            return array();
        }
    }

    public function accessRules()
    {
        if(isset($this->module->useYiiAuth) && $this->module->useYiiAuth && isset($this->module->yiiAuthItem))
        {
            $rules = array(
                array('allow', 'actions' => array('check', 'saveConfig'), 'expression' => '$user->checkAccess("'.$this->module->yiiAuthItem.'")'),
                array('deny', 'users' => array('*')),
            );
        }else{
            $rules = array(
                array('allow', 'actions' => array('check', 'saveConfig'), 'users' => array('admin')),
                array('deny', 'users' => array('*')),
            );
        }

        return $rules;
    }

    public function actionCheck()
    {
        $items = DsConfig::getItems(DsConfig::getFilename(), DsConfig::getVarName());
        $params = Yii::app()->params;

        if(Yii::app()->request->requestType === 'POST')
        {
            $this->saveconfig($items);
            $this->redirect('check');
        }

        $testresult = $this->testConfig();

        $this->render('check', array(
            'items' => $items,
            'params' => $params,
            'testresult' => $testresult,
        ));
    }

    private function saveConfig($items)
    {
        $params = array();

        foreach($items as $key => $item)
        {
            if(isset($_POST[$key]) AND $_POST[$key] != '')
            {
                $params[$key] = $_POST[$key];
            }
        }

        $filename = $this->module->paramsFile;

        if(is_writable($filename))
        {
            if(file_put_contents($filename, '<?php $params = '.var_export($params, true).'; ?>') !== true)
            {
                Yii::app()->user->setFlash('success', Yii::t('dsconfigModule.app', 'Configuration saved!'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('dsconfigModule.app', 'Configuration could not be saved!'));
            }
        }else{
            Yii::app()->user->setFlash('error', Yii::t('dsconfigModule.app', 'Can\'t write configuration file \'{filename}\'. Please run \'extras/fixPermissions.sh\' to correct file permissions.', array('{filename}' => $filename)));
        }
    }

    private function testConfig()
    {
        $testresult = DsConfig::test();

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
