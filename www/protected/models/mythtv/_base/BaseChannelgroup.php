<?php

/**
 * This is the model base class for the table "channelgroup".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Channelgroup".
 *
 * Columns in table "channelgroup" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $id
 * @property string $chanid
 * @property integer $grpid
 *
 */
abstract class BaseChannelgroup extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'channelgroup';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Channelgroup|Channelgroups', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('grpid', 'numerical', 'integerOnly'=>true),
			array('chanid', 'length', 'max'=>11),
			array('chanid, grpid', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, chanid, grpid', 'safe', 'on'=>'search'),
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
			'chanid' => Yii::t('app', 'Chanid'),
			'grpid' => Yii::t('app', 'Grpid'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('chanid', $this->chanid, true);
		$criteria->compare('grpid', $this->grpid);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}