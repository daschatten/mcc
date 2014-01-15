<?php

/**
 * This is the model base class for the table "cardinput".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Cardinput".
 *
 * Columns in table "cardinput" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $cardinputid
 * @property string $cardid
 * @property string $sourceid
 * @property string $inputname
 * @property string $externalcommand
 * @property string $changer_device
 * @property string $changer_model
 * @property string $tunechan
 * @property string $startchan
 * @property string $displayname
 * @property integer $dishnet_eit
 * @property integer $recpriority
 * @property integer $quicktune
 * @property string $schedorder
 * @property string $livetvorder
 *
 */
abstract class BaseCardinput extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'cardinput';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Cardinput|Cardinputs', $n);
	}

	public static function representingColumn() {
		return 'inputname';
	}

	public function rules() {
		return array(
			array('dishnet_eit, recpriority, quicktune', 'numerical', 'integerOnly'=>true),
			array('cardid, sourceid, tunechan, startchan, schedorder, livetvorder', 'length', 'max'=>10),
			array('inputname', 'length', 'max'=>32),
			array('externalcommand, changer_device, changer_model', 'length', 'max'=>128),
			array('displayname', 'length', 'max'=>64),
			array('cardid, sourceid, inputname, externalcommand, changer_device, changer_model, tunechan, startchan, displayname, dishnet_eit, recpriority, quicktune, schedorder, livetvorder', 'default', 'setOnEmpty' => true, 'value' => null),
			array('cardinputid, cardid, sourceid, inputname, externalcommand, changer_device, changer_model, tunechan, startchan, displayname, dishnet_eit, recpriority, quicktune, schedorder, livetvorder', 'safe', 'on'=>'search'),
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
			'cardinputid' => Yii::t('app', 'Cardinputid'),
			'cardid' => Yii::t('app', 'Cardid'),
			'sourceid' => Yii::t('app', 'Sourceid'),
			'inputname' => Yii::t('app', 'Inputname'),
			'externalcommand' => Yii::t('app', 'Externalcommand'),
			'changer_device' => Yii::t('app', 'Changer Device'),
			'changer_model' => Yii::t('app', 'Changer Model'),
			'tunechan' => Yii::t('app', 'Tunechan'),
			'startchan' => Yii::t('app', 'Startchan'),
			'displayname' => Yii::t('app', 'Displayname'),
			'dishnet_eit' => Yii::t('app', 'Dishnet Eit'),
			'recpriority' => Yii::t('app', 'Recpriority'),
			'quicktune' => Yii::t('app', 'Quicktune'),
			'schedorder' => Yii::t('app', 'Schedorder'),
			'livetvorder' => Yii::t('app', 'Livetvorder'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('cardinputid', $this->cardinputid, true);
		$criteria->compare('cardid', $this->cardid, true);
		$criteria->compare('sourceid', $this->sourceid, true);
		$criteria->compare('inputname', $this->inputname, true);
		$criteria->compare('externalcommand', $this->externalcommand, true);
		$criteria->compare('changer_device', $this->changer_device, true);
		$criteria->compare('changer_model', $this->changer_model, true);
		$criteria->compare('tunechan', $this->tunechan, true);
		$criteria->compare('startchan', $this->startchan, true);
		$criteria->compare('displayname', $this->displayname, true);
		$criteria->compare('dishnet_eit', $this->dishnet_eit);
		$criteria->compare('recpriority', $this->recpriority);
		$criteria->compare('quicktune', $this->quicktune);
		$criteria->compare('schedorder', $this->schedorder, true);
		$criteria->compare('livetvorder', $this->livetvorder, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}