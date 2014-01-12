<?php

/**
 * This is the model base class for the table "recordedartwork".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Recordedartwork".
 *
 * Columns in table "recordedartwork" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $inetref
 * @property integer $season
 * @property string $host
 * @property string $coverart
 * @property string $fanart
 * @property string $banner
 *
 */
abstract class BaseRecordedartwork extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'recordedartwork';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Recordedartwork|Recordedartworks', $n);
	}

	public static function representingColumn() {
		return 'inetref';
	}

	public function rules() {
		return array(
			array('inetref, season, host, coverart, fanart, banner', 'required'),
			array('season', 'numerical', 'integerOnly'=>true),
			array('inetref', 'length', 'max'=>255),
			array('inetref, season, host, coverart, fanart, banner', 'safe', 'on'=>'search'),
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
			'inetref' => Yii::t('app', 'Inetref'),
			'season' => Yii::t('app', 'Season'),
			'host' => Yii::t('app', 'Host'),
			'coverart' => Yii::t('app', 'Coverart'),
			'fanart' => Yii::t('app', 'Fanart'),
			'banner' => Yii::t('app', 'Banner'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('inetref', $this->inetref, true);
		$criteria->compare('season', $this->season);
		$criteria->compare('host', $this->host, true);
		$criteria->compare('coverart', $this->coverart, true);
		$criteria->compare('fanart', $this->fanart, true);
		$criteria->compare('banner', $this->banner, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}