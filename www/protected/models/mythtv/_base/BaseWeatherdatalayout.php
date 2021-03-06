<?php

/**
 * This is the model base class for the table "weatherdatalayout".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Weatherdatalayout".
 *
 * Columns in table "weatherdatalayout" available as properties of the model,
 * followed by relations of table "weatherdatalayout" available as properties of the model.
 *
 * @property string $location
 * @property string $dataitem
 * @property string $weatherscreens_screen_id
 * @property string $weathersourcesettings_sourceid
 *
 * @property Weatherscreens $weatherscreensScreen
 * @property Weathersourcesettings $weathersourcesettingsSource
 */
abstract class BaseWeatherdatalayout extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'weatherdatalayout';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Weatherdatalayout|Weatherdatalayouts', $n);
	}

	public static function representingColumn() {
		return 'location';
	}

	public function rules() {
		return array(
			array('location, dataitem, weatherscreens_screen_id, weathersourcesettings_sourceid', 'required'),
			array('location', 'length', 'max'=>128),
			array('dataitem', 'length', 'max'=>64),
			array('weatherscreens_screen_id, weathersourcesettings_sourceid', 'length', 'max'=>10),
			array('location, dataitem, weatherscreens_screen_id, weathersourcesettings_sourceid', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'weatherscreensScreen' => array(self::BELONGS_TO, 'Weatherscreens', 'weatherscreens_screen_id'),
			'weathersourcesettingsSource' => array(self::BELONGS_TO, 'Weathersourcesettings', 'weathersourcesettings_sourceid'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'location' => Yii::t('app', 'Location'),
			'dataitem' => Yii::t('app', 'Dataitem'),
			'weatherscreens_screen_id' => null,
			'weathersourcesettings_sourceid' => null,
			'weatherscreensScreen' => null,
			'weathersourcesettingsSource' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('location', $this->location, true);
		$criteria->compare('dataitem', $this->dataitem, true);
		$criteria->compare('weatherscreens_screen_id', $this->weatherscreens_screen_id);
		$criteria->compare('weathersourcesettings_sourceid', $this->weathersourcesettings_sourceid);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}