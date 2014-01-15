<?php

/**
 * This is the model base class for the table "scannerfile".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Scannerfile".
 *
 * Columns in table "scannerfile" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $fileid
 * @property string $filesize
 * @property string $filehash
 * @property string $added
 *
 */
abstract class BaseScannerfile extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'scannerfile';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Scannerfile|Scannerfiles', $n);
	}

	public static function representingColumn() {
		return 'filehash';
	}

	public function rules() {
		return array(
			array('added', 'required'),
			array('filesize', 'length', 'max'=>20),
			array('filehash', 'length', 'max'=>64),
			array('filesize, filehash', 'default', 'setOnEmpty' => true, 'value' => null),
			array('fileid, filesize, filehash, added', 'safe', 'on'=>'search'),
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
			'filesize' => Yii::t('app', 'Filesize'),
			'filehash' => Yii::t('app', 'Filehash'),
			'added' => Yii::t('app', 'Added'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('fileid', $this->fileid, true);
		$criteria->compare('filesize', $this->filesize, true);
		$criteria->compare('filehash', $this->filehash, true);
		$criteria->compare('added', $this->added, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}