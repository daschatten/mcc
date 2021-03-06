<?php

Yii::import('application.models.mythtv._base.BaseRecorded');

class Recorded extends BaseRecorded
{
    public $episodeCount;

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
                'pageSize'=>DsConfig::get('defaultPageSize'),
            ),
            'sort'=>array(
                'defaultOrder'=>'starttime DESC',
              )
		));
	}

    public function relations()
    {
        return array(
            'channel'=>array(self::BELONGS_TO, 'Channel', 'chanid'),
        );
    }

    public function attributeLabels() {
        $a = array(
            'channel.name' => Yii::t('app', 'Channel'),
            'FilesizeGb' => Yii::t('app', 'Size (GB)'),
            'episodeString' => Yii::t('app', 'Season/Episode'),
            'length' => Yii::t('app', 'Length (Min.)'),
            'recgroup' => Yii::t('app', 'Group'),
        );
        
        $m = array_merge(parent::attributeLabels(), $a);
        return $m;
    }

    public static function getRecgroups()
    {
        $mr = new Recorded();

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

    /**
     * Returns length of recording
     */
    public function getLength()
    {
        $sec = strtotime($this->endtime) - strtotime($this->starttime);   
        $min = ceil($sec/60);
        return $min;
    }

    /**
     * Return combined season/episode string
     */
    public function getEpisodeString()
    {
        if($this->episode <> 0)
        {
            return $this->season."x".$this->episode;
        }else
        {
            return "";
        }
    }

    /**
     * Returns starttime as unix timestamp in combination with timezone offset
     */
    public function getLocalStarttime()
    {
        // get timezone offset for date calculations because mythtv treats given time as utc
        $tzoffset = timezone_offset_get(new DateTimeZone(DsConfig::get('timezone')), new DateTime(null, new DateTimeZone('UTC')));

        return strtotime($this->starttime) + $tzoffset;
    }
}
