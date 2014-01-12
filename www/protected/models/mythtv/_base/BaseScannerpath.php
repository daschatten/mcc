<?php

/**
 * This is the model base class for the table "scannerpath".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Scannerpath".
 *
 * Columns in table "scannerpath" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $fileid
 * @property string $hostname
 * @property string $storagegroup
 * @property string $filename
 *
 */
abstract class BaseScannerpath extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'scannerpath';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Scannerpath|Scannerpaths', $n);
	}

	public static function representingColumn() {
		return 'hostname';
	}

	public function rules() {
		return array(
			array('fileid', 'required'),
			array('fileid', 'length', 'max'=>20),
			array('hostname', 'length', 'max'=>64),
			array('storagegroup', 'length', 'max'=>32),
			array('filename', 'length', 'max'=>255),
			array('hostname, storagegroup, filename', 'default', 'setOnEmpty' => true, 'value' => null),
			array('fileid, hostname, storagegroup, filename', 'safe', 'on'=>'search'),
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
			'fileid' => Yii::t('app', 'Fileid'),
			'hostname' => Yii::t('app', 'Hostname'),
			'storagegroup' => Yii::t('app', 'Storagegroup'),
			'filename' => Yii::t('app', 'Filename'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('fileid', $this->fileid, true);
		$criteria->compare('hostname', $this->hostname, true);
		$criteria->compare('storagegroup', $this->storagegroup, true);
		$criteria->compare('filename', $this->filename, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}