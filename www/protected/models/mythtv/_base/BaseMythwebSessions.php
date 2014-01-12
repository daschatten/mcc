<?php

/**
 * This is the model base class for the table "mythweb_sessions".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MythwebSessions".
 *
 * Columns in table "mythweb_sessions" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $id
 * @property string $modified
 * @property string $data
 *
 */
abstract class BaseMythwebSessions extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'mythweb_sessions';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'MythwebSessions|MythwebSessions', $n);
	}

	public static function representingColumn() {
		return 'modified';
	}

	public function rules() {
		return array(
			array('modified, data', 'required'),
			array('id', 'length', 'max'=>128),
			array('id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, modified, data', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('app', 'ID'),
			'modified' => Yii::t('app', 'Modified'),
			'data' => Yii::t('app', 'Data'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('modified', $this->modified, true);
		$criteria->compare('data', $this->data, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}