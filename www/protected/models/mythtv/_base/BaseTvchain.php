<?php

/**
 * This is the model base class for the table "tvchain".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Tvchain".
 *
 * Columns in table "tvchain" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $chanid
 * @property string $starttime
 * @property string $chainid
 * @property integer $chainpos
 * @property integer $discontinuity
 * @property integer $watching
 * @property string $hostprefix
 * @property string $cardtype
 * @property string $input
 * @property string $channame
 * @property string $endtime
 *
 */
abstract class BaseTvchain extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tvchain';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Tvchain|Tvchains', $n);
	}

	public static function representingColumn() {
		return 'chainid';
	}

	public function rules() {
		return array(
			array('chainpos, discontinuity, watching', 'numerical', 'integerOnly'=>true),
			array('chanid', 'length', 'max'=>10),
			array('chainid, hostprefix', 'length', 'max'=>128),
			array('cardtype, input, channame', 'length', 'max'=>32),
			array('endtime', 'safe'),
			array('chanid, starttime, chainid, chainpos, discontinuity, watching, hostprefix, cardtype, input, channame, endtime', 'default', 'setOnEmpty' => true, 'value' => null),
			array('chanid, starttime, chainid, chainpos, discontinuity, watching, hostprefix, cardtype, input, channame, endtime', 'safe', 'on'=>'search'),
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
			'chainid' => Yii::t('app', 'Chainid'),
			'chainpos' => Yii::t('app', 'Chainpos'),
			'discontinuity' => Yii::t('app', 'Discontinuity'),
			'watching' => Yii::t('app', 'Watching'),
			'hostprefix' => Yii::t('app', 'Hostprefix'),
			'cardtype' => Yii::t('app', 'Cardtype'),
			'input' => Yii::t('app', 'Input'),
			'channame' => Yii::t('app', 'Channame'),
			'endtime' => Yii::t('app', 'Endtime'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('chanid', $this->chanid, true);
		$criteria->compare('starttime', $this->starttime, true);
		$criteria->compare('chainid', $this->chainid, true);
		$criteria->compare('chainpos', $this->chainpos);
		$criteria->compare('discontinuity', $this->discontinuity);
		$criteria->compare('watching', $this->watching);
		$criteria->compare('hostprefix', $this->hostprefix, true);
		$criteria->compare('cardtype', $this->cardtype, true);
		$criteria->compare('input', $this->input, true);
		$criteria->compare('channame', $this->channame, true);
		$criteria->compare('endtime', $this->endtime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}