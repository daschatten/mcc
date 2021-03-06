<?php

/**
 * This is the model base class for the table "recordedcredits".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Recordedcredits".
 *
 * Columns in table "recordedcredits" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $person
 * @property string $chanid
 * @property string $starttime
 * @property string $role
 *
 */
abstract class BaseRecordedcredits extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'recordedcredits';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Recordedcredits|Recordedcredits', $n);
	}

	public static function representingColumn() {
		return 'starttime';
	}

	public function rules() {
		return array(
			array('person', 'numerical', 'integerOnly'=>true),
			array('chanid', 'length', 'max'=>10),
			array('person, chanid, starttime, role', 'default', 'setOnEmpty' => true, 'value' => null),
			array('person, chanid, starttime, role', 'safe', 'on'=>'search'),
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
			'person' => Yii::t('app', 'Person'),
			'chanid' => Yii::t('app', 'Chanid'),
			'starttime' => Yii::t('app', 'Starttime'),
			'role' => Yii::t('app', 'Role'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('person', $this->person);
		$criteria->compare('chanid', $this->chanid, true);
		$criteria->compare('starttime', $this->starttime, true);
		$criteria->compare('role', $this->role, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}