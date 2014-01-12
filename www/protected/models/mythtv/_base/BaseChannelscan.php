<?php

/**
 * This is the model base class for the table "channelscan".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Channelscan".
 *
 * Columns in table "channelscan" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $scanid
 * @property string $cardid
 * @property string $sourceid
 * @property integer $processed
 * @property string $scandate
 *
 */
abstract class BaseChannelscan extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'channelscan';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Channelscan|Channelscans', $n);
	}

	public static function representingColumn() {
		return 'scandate';
	}

	public function rules() {
		return array(
			array('cardid, sourceid, processed, scandate', 'required'),
			array('processed', 'numerical', 'integerOnly'=>true),
			array('cardid, sourceid', 'length', 'max'=>3),
			array('scanid, cardid, sourceid, processed, scandate', 'safe', 'on'=>'search'),
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
			'scanid' => Yii::t('app', 'Scanid'),
			'cardid' => Yii::t('app', 'Cardid'),
			'sourceid' => Yii::t('app', 'Sourceid'),
			'processed' => Yii::t('app', 'Processed'),
			'scandate' => Yii::t('app', 'Scandate'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('scanid', $this->scanid, true);
		$criteria->compare('cardid', $this->cardid, true);
		$criteria->compare('sourceid', $this->sourceid, true);
		$criteria->compare('processed', $this->processed);
		$criteria->compare('scandate', $this->scandate, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}