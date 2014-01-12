<?php

/**
 * This is the model base class for the table "diseqc_tree".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "DiseqcTree".
 *
 * Columns in table "diseqc_tree" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $diseqcid
 * @property string $parentid
 * @property integer $ordinal
 * @property string $type
 * @property string $subtype
 * @property string $description
 * @property integer $switch_ports
 * @property double $rotor_hi_speed
 * @property double $rotor_lo_speed
 * @property string $rotor_positions
 * @property integer $lnb_lof_switch
 * @property integer $lnb_lof_hi
 * @property integer $lnb_lof_lo
 * @property integer $cmd_repeat
 * @property integer $lnb_pol_inv
 * @property integer $address
 *
 */
abstract class BaseDiseqcTree extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'diseqc_tree';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'DiseqcTree|DiseqcTrees', $n);
	}

	public static function representingColumn() {
		return 'type';
	}

	public function rules() {
		return array(
			array('ordinal', 'required'),
			array('ordinal, switch_ports, lnb_lof_switch, lnb_lof_hi, lnb_lof_lo, cmd_repeat, lnb_pol_inv, address', 'numerical', 'integerOnly'=>true),
			array('rotor_hi_speed, rotor_lo_speed', 'numerical'),
			array('parentid', 'length', 'max'=>10),
			array('type, subtype', 'length', 'max'=>16),
			array('description', 'length', 'max'=>32),
			array('rotor_positions', 'length', 'max'=>255),
			array('parentid, type, subtype, description, switch_ports, rotor_hi_speed, rotor_lo_speed, rotor_positions, lnb_lof_switch, lnb_lof_hi, lnb_lof_lo, cmd_repeat, lnb_pol_inv, address', 'default', 'setOnEmpty' => true, 'value' => null),
			array('diseqcid, parentid, ordinal, type, subtype, description, switch_ports, rotor_hi_speed, rotor_lo_speed, rotor_positions, lnb_lof_switch, lnb_lof_hi, lnb_lof_lo, cmd_repeat, lnb_pol_inv, address', 'safe', 'on'=>'search'),
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
			'diseqcid' => Yii::t('app', 'Diseqcid'),
			'parentid' => Yii::t('app', 'Parentid'),
			'ordinal' => Yii::t('app', 'Ordinal'),
			'type' => Yii::t('app', 'Type'),
			'subtype' => Yii::t('app', 'Subtype'),
			'description' => Yii::t('app', 'Description'),
			'switch_ports' => Yii::t('app', 'Switch Ports'),
			'rotor_hi_speed' => Yii::t('app', 'Rotor Hi Speed'),
			'rotor_lo_speed' => Yii::t('app', 'Rotor Lo Speed'),
			'rotor_positions' => Yii::t('app', 'Rotor Positions'),
			'lnb_lof_switch' => Yii::t('app', 'Lnb Lof Switch'),
			'lnb_lof_hi' => Yii::t('app', 'Lnb Lof Hi'),
			'lnb_lof_lo' => Yii::t('app', 'Lnb Lof Lo'),
			'cmd_repeat' => Yii::t('app', 'Cmd Repeat'),
			'lnb_pol_inv' => Yii::t('app', 'Lnb Pol Inv'),
			'address' => Yii::t('app', 'Address'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('diseqcid', $this->diseqcid, true);
		$criteria->compare('parentid', $this->parentid, true);
		$criteria->compare('ordinal', $this->ordinal);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('subtype', $this->subtype, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('switch_ports', $this->switch_ports);
		$criteria->compare('rotor_hi_speed', $this->rotor_hi_speed);
		$criteria->compare('rotor_lo_speed', $this->rotor_lo_speed);
		$criteria->compare('rotor_positions', $this->rotor_positions, true);
		$criteria->compare('lnb_lof_switch', $this->lnb_lof_switch);
		$criteria->compare('lnb_lof_hi', $this->lnb_lof_hi);
		$criteria->compare('lnb_lof_lo', $this->lnb_lof_lo);
		$criteria->compare('cmd_repeat', $this->cmd_repeat);
		$criteria->compare('lnb_pol_inv', $this->lnb_pol_inv);
		$criteria->compare('address', $this->address);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}