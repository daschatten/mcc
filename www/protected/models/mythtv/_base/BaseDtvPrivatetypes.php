<?php

/**
 * This is the model base class for the table "dtv_privatetypes".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "DtvPrivatetypes".
 *
 * Columns in table "dtv_privatetypes" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $sitype
 * @property integer $networkid
 * @property string $private_type
 * @property string $private_value
 *
 */
abstract class BaseDtvPrivatetypes extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'dtv_privatetypes';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'DtvPrivatetypes|DtvPrivatetypes', $n);
	}

	public static function representingColumn() {
		return 'sitype';
	}

	public function rules() {
		return array(
			array('networkid', 'numerical', 'integerOnly'=>true),
			array('sitype', 'length', 'max'=>4),
			array('private_type', 'length', 'max'=>20),
			array('private_value', 'length', 'max'=>100),
			array('sitype, networkid, private_type, private_value', 'default', 'setOnEmpty' => true, 'value' => null),
			array('sitype, networkid, private_type, private_value', 'safe', 'on'=>'search'),
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
			'sitype' => Yii::t('app', 'Sitype'),
			'networkid' => Yii::t('app', 'Networkid'),
			'private_type' => Yii::t('app', 'Private Type'),
			'private_value' => Yii::t('app', 'Private Value'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('sitype', $this->sitype, true);
		$criteria->compare('networkid', $this->networkid);
		$criteria->compare('private_type', $this->private_type, true);
		$criteria->compare('private_value', $this->private_value, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}