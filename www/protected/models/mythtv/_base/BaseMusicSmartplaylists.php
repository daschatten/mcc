<?php

/**
 * This is the model base class for the table "music_smartplaylists".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MusicSmartplaylists".
 *
 * Columns in table "music_smartplaylists" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $smartplaylistid
 * @property string $name
 * @property string $categoryid
 * @property string $matchtype
 * @property string $orderby
 * @property string $limitto
 *
 */
abstract class BaseMusicSmartplaylists extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'music_smartplaylists';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'MusicSmartplaylists|MusicSmartplaylists', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, categoryid', 'required'),
			array('name, orderby', 'length', 'max'=>128),
			array('categoryid, limitto', 'length', 'max'=>10),
			array('matchtype', 'safe'),
			array('matchtype, orderby, limitto', 'default', 'setOnEmpty' => true, 'value' => null),
			array('smartplaylistid, name, categoryid, matchtype, orderby, limitto', 'safe', 'on'=>'search'),
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
			'smartplaylistid' => Yii::t('app', 'Smartplaylistid'),
			'name' => Yii::t('app', 'Name'),
			'categoryid' => Yii::t('app', 'Categoryid'),
			'matchtype' => Yii::t('app', 'Matchtype'),
			'orderby' => Yii::t('app', 'Orderby'),
			'limitto' => Yii::t('app', 'Limitto'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('smartplaylistid', $this->smartplaylistid, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('categoryid', $this->categoryid, true);
		$criteria->compare('matchtype', $this->matchtype, true);
		$criteria->compare('orderby', $this->orderby, true);
		$criteria->compare('limitto', $this->limitto, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}