<?php

/**
 * This is the model base class for the table "videometadatacast".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Videometadatacast".
 *
 * Columns in table "videometadatacast" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $idvideo
 * @property string $idcast
 *
 */
abstract class BaseVideometadatacast extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'videometadatacast';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Videometadatacast|Videometadatacasts', $n);
	}

	public static function representingColumn() {
		return array(
			'idvideo',
			'idcast',
		);
	}

	public function rules() {
		return array(
			array('idvideo, idcast', 'required'),
			array('idvideo, idcast', 'length', 'max'=>10),
			array('idvideo, idcast', 'safe', 'on'=>'search'),
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
			'idvideo' => Yii::t('app', 'Idvideo'),
			'idcast' => Yii::t('app', 'Idcast'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('idvideo', $this->idvideo, true);
		$criteria->compare('idcast', $this->idcast, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}