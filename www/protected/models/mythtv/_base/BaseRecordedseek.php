<?php

/**
 * This is the model base class for the table "recordedseek".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Recordedseek".
 *
 * Columns in table "recordedseek" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $chanid
 * @property string $starttime
 * @property integer $mark
 * @property string $offset
 * @property integer $type
 *
 */
abstract class BaseRecordedseek extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'recordedseek';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Recordedseek|Recordedseeks', $n);
	}

	public static function representingColumn() {
		return 'starttime';
	}

	public function rules() {
		return array(
			array('offset', 'required'),
			array('mark, type', 'numerical', 'integerOnly'=>true),
			array('chanid', 'length', 'max'=>10),
			array('offset', 'length', 'max'=>20),
			array('chanid, starttime, mark, type', 'default', 'setOnEmpty' => true, 'value' => null),
			array('chanid, starttime, mark, offset, type', 'safe', 'on'=>'search'),
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
			'mark' => Yii::t('app', 'Mark'),
			'offset' => Yii::t('app', 'Offset'),
			'type' => Yii::t('app', 'Type'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('chanid', $this->chanid, true);
		$criteria->compare('starttime', $this->starttime, true);
		$criteria->compare('mark', $this->mark);
		$criteria->compare('offset', $this->offset, true);
		$criteria->compare('type', $this->type);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}