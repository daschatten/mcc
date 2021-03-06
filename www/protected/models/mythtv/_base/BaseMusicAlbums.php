<?php

/**
 * This is the model base class for the table "music_albums".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MusicAlbums".
 *
 * Columns in table "music_albums" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $album_id
 * @property string $artist_id
 * @property string $album_name
 * @property integer $year
 * @property integer $compilation
 *
 */
abstract class BaseMusicAlbums extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'music_albums';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'MusicAlbums|MusicAlbums', $n);
	}

	public static function representingColumn() {
		return 'album_name';
	}

	public function rules() {
		return array(
			array('year, compilation', 'numerical', 'integerOnly'=>true),
			array('artist_id', 'length', 'max'=>11),
			array('album_name', 'length', 'max'=>255),
			array('artist_id, album_name, year, compilation', 'default', 'setOnEmpty' => true, 'value' => null),
			array('album_id, artist_id, album_name, year, compilation', 'safe', 'on'=>'search'),
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
			'album_id' => Yii::t('app', 'Album'),
			'artist_id' => Yii::t('app', 'Artist'),
			'album_name' => Yii::t('app', 'Album Name'),
			'year' => Yii::t('app', 'Year'),
			'compilation' => Yii::t('app', 'Compilation'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('album_id', $this->album_id, true);
		$criteria->compare('artist_id', $this->artist_id, true);
		$criteria->compare('album_name', $this->album_name, true);
		$criteria->compare('year', $this->year);
		$criteria->compare('compilation', $this->compilation);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}