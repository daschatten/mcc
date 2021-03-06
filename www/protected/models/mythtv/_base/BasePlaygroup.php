<?php

/**
 * This is the model base class for the table "playgroup".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Playgroup".
 *
 * Columns in table "playgroup" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $name
 * @property string $titlematch
 * @property integer $skipahead
 * @property integer $skipback
 * @property integer $timestretch
 * @property integer $jump
 *
 */
abstract class BasePlaygroup extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'playgroup';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Playgroup|Playgroups', $n);
	}

	public static function representingColumn() {
		return 'titlematch';
	}

	public function rules() {
		return array(
			array('skipahead, skipback, timestretch, jump', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('titlematch', 'length', 'max'=>255),
			array('name, titlematch, skipahead, skipback, timestretch, jump', 'default', 'setOnEmpty' => true, 'value' => null),
			array('name, titlematch, skipahead, skipback, timestretch, jump', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('app', 'Name'),
			'titlematch' => Yii::t('app', 'Titlematch'),
			'skipahead' => Yii::t('app', 'Skipahead'),
			'skipback' => Yii::t('app', 'Skipback'),
			'timestretch' => Yii::t('app', 'Timestretch'),
			'jump' => Yii::t('app', 'Jump'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('name', $this->name, true);
		$criteria->compare('titlematch', $this->titlematch, true);
		$criteria->compare('skipahead', $this->skipahead);
		$criteria->compare('skipback', $this->skipback);
		$criteria->compare('timestretch', $this->timestretch);
		$criteria->compare('jump', $this->jump);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}