<?php

Yii::import('application.models.mythtv._base.BaseStoragegroup');

class Storagegroup extends BaseStoragegroup
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'recordings' => array(self::HAS_MANY, 'Recorded', array('storagegroup' => 'groupname')),
        );
    }

    public function getSpaceused()
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'sum(filesize)';
        $criteria->addColumnCondition(array('storagegroup' => $this->groupname));

        $model = Recorded::model();

        $val = $model->commandBuilder->createFindCommand(
            $model->tableName(), $criteria)->queryScalar(); 

        return $val;
    }
    
    public function getRecordingsCount()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "storagegroup = :sg";
        $criteria->params = array(':sg' => $this->groupname);

        $val = Recorded::model()->count($criteria);

        return $val;
    }

}
