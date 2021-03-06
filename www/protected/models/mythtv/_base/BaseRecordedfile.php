<?php

/**
 * This is the model base class for the table "recordedfile".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Recordedfile".
 *
 * Columns in table "recordedfile" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $chanid
 * @property string $starttime
 * @property string $basename
 * @property string $filesize
 * @property integer $width
 * @property integer $height
 * @property double $fps
 * @property double $aspect
 * @property integer $audio_sample_rate
 * @property integer $audio_bits_per_sample
 * @property integer $audio_channels
 * @property string $audio_type
 * @property string $video_type
 * @property string $comment
 * @property string $hostname
 * @property string $storagegroup
 * @property integer $id
 *
 */
abstract class BaseRecordedfile extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'recordedfile';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Recordedfile|Recordedfiles', $n);
	}

	public static function representingColumn() {
		return 'starttime';
	}

	public function rules() {
		return array(
			array('hostname, storagegroup', 'required'),
			array('width, height, audio_sample_rate, audio_bits_per_sample, audio_channels', 'numerical', 'integerOnly'=>true),
			array('fps, aspect', 'numerical'),
			array('chanid', 'length', 'max'=>10),
			array('basename', 'length', 'max'=>128),
			array('filesize', 'length', 'max'=>20),
			array('audio_type, video_type, comment', 'length', 'max'=>255),
			array('hostname', 'length', 'max'=>64),
			array('storagegroup', 'length', 'max'=>32),
			array('starttime', 'safe'),
			array('chanid, starttime, basename, filesize, width, height, fps, aspect, audio_sample_rate, audio_bits_per_sample, audio_channels, audio_type, video_type, comment', 'default', 'setOnEmpty' => true, 'value' => null),
			array('chanid, starttime, basename, filesize, width, height, fps, aspect, audio_sample_rate, audio_bits_per_sample, audio_channels, audio_type, video_type, comment, hostname, storagegroup, id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'chanid' => Yii::t('app', 'Chanid'),
			'starttime' => Yii::t('app', 'Starttime'),
			'basename' => Yii::t('app', 'Basename'),
			'filesize' => Yii::t('app', 'Filesize'),
			'width' => Yii::t('app', 'Width'),
			'height' => Yii::t('app', 'Height'),
			'fps' => Yii::t('app', 'Fps'),
			'aspect' => Yii::t('app', 'Aspect'),
			'audio_sample_rate' => Yii::t('app', 'Audio Sample Rate'),
			'audio_bits_per_sample' => Yii::t('app', 'Audio Bits Per Sample'),
			'audio_channels' => Yii::t('app', 'Audio Channels'),
			'audio_type' => Yii::t('app', 'Audio Type'),
			'video_type' => Yii::t('app', 'Video Type'),
			'comment' => Yii::t('app', 'Comment'),
			'hostname' => Yii::t('app', 'Hostname'),
			'storagegroup' => Yii::t('app', 'Storagegroup'),
			'id' => Yii::t('app', 'ID'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('chanid', $this->chanid, true);
		$criteria->compare('starttime', $this->starttime, true);
		$criteria->compare('basename', $this->basename, true);
		$criteria->compare('filesize', $this->filesize, true);
		$criteria->compare('width', $this->width);
		$criteria->compare('height', $this->height);
		$criteria->compare('fps', $this->fps);
		$criteria->compare('aspect', $this->aspect);
		$criteria->compare('audio_sample_rate', $this->audio_sample_rate);
		$criteria->compare('audio_bits_per_sample', $this->audio_bits_per_sample);
		$criteria->compare('audio_channels', $this->audio_channels);
		$criteria->compare('audio_type', $this->audio_type, true);
		$criteria->compare('video_type', $this->video_type, true);
		$criteria->compare('comment', $this->comment, true);
		$criteria->compare('hostname', $this->hostname, true);
		$criteria->compare('storagegroup', $this->storagegroup, true);
		$criteria->compare('id', $this->id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}