<?php

Yii::import('application.models._base.BaseMRecorded');

class MRecorded extends BaseMRecorded
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('chanid', $this->chanid, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('subtitle', $this->subtitle, true);
		$criteria->compare('recgroup', $this->recgroup, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['defaultPageSize'],
            ),
            'sort'=>array(
                'defaultOrder'=>'starttime DESC',
              )
		));
	}

    public function relations()
    {
        return array(
            'channel'=>array(self::BELONGS_TO, 'MChannel', 'chanid'),
        );
    }

    public function attributeLabels() {
        $a = array(
            'channel.name' => Yii::t('app', 'Channel'),
            'FilesizeGb' => Yii::t('app', 'Size (GB)'),
        );
        
        $m = array_merge(parent::attributeLabels(), $a);
        return $m;
    }

    public static function getRecgroups()
    {
        $mr = new MRecorded();

        $recgroups = Yii::app()->db->createCommand()
            ->selectDistinct('recgroup')
            ->from($mr->tableName())
            ->queryAll();


        # we need an array with key and value be the same
        $a = array();

        foreach($recgroups as $r)
        {
            $val = $r['recgroup'];
            $a[$val] = $val;
        }

        return $a;    
    }

    /**
     * Returns filesize in gigabytes
     */
    public function getFilesizeGb()
    {
        return round($this->filesize / (1024 * 1024 * 1024), 2);
    }

}
