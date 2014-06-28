<?php

class RecordTemplatesController extends GxController
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 'roles' => array('o_manage_recordtemplates')),
            array('deny', 'users' => array('*')),
        );
    }

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'RecordTemplates'),
		));
	}

	public function actionCreate() {
		$model = new RecordTemplates;
        $recordTemplates = Record::getTemplates();
        $recordTypes = Record::recordTypes();

		if (isset($_POST['RecordTemplates'])) {
			$model->setAttributes($_POST['RecordTemplates']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('admin'));
			}
		}

		$this->render('create', array( 
            'model' => $model,
            'recordTemplates' => $recordTemplates,
            'recordTypes' => $recordTypes,
        ));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'RecordTemplates');
        $recordTemplates = Record::getTemplates();
        $recordTypes = Record::recordTypes();

		if (isset($_POST['RecordTemplates'])) {
			$model->setAttributes($_POST['RecordTemplates']);

			if ($model->save()) {
				$this->redirect(array('admin'));
			}
		}

		$this->render('update', array(
				'model' => $model,
                'recordTemplates' => $recordTemplates,
                'recordTypes' => $recordTypes,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'RecordTemplates')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
        $this->actionAdmin();
/*		$dataProvider = new CActiveDataProvider('RecordTemplates');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
*/
	}

	public function actionAdmin() {
		$model = new RecordTemplates('search');
		$model->unsetAttributes();

		if (isset($_GET['RecordTemplates']))
			$model->setAttributes($_GET['RecordTemplates']);

        $recordTemplates = Record::getTemplates();
        $recordTypes = Record::recordTypes();

		$this->render('admin', array(
			'model' => $model,
            'recordTemplates' => $recordTemplates,
            'recordTypes' => $recordTypes,
		));
	}

}
