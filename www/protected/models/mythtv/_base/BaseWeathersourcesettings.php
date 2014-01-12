<?php

/**
 * This is the model base class for the table "weathersourcesettings".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Weathersourcesettings".
 *
 * Columns in table "weathersourcesettings" available as properties of the model,
 * followed by relations of table "weathersourcesettings" available as properties of the model.
 *
 * @property string $sourceid
 * @property string $source_name
 * @property string $update_timeout
 * @property string $retrieve_timeout
 * @property string $hostname
 * @property string $path
 * @property string $author
 * @property string $version
 * @property string $email
 * @property string $types
 * @property string $updated
 *
 * @property Weatherdatalayout[] $weatherdatalayouts
 */
abstract class BaseWeathersourcesettings extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'weathersourcesettings';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Weathersourcesettings|Weathersourcesettings', $n);
	}

	public static function representingColumn() {
		return 'source_name';
	}

	public function rules() {
		return array(
			array('source_name, updated', 'required'),
			array('source_name, hostname', 'length', 'max'=>64),
			array('update_timeout, retrieve_timeout', 'length', 'max'=>10),
			array('path, email', 'length', 'max'=>255),
			array('author', 'length', 'max'=>128),
			array('version', 'length', 'max'=>32),
			array('types', 'safe'),
			array('update_timeout, retrieve_timeout, hostname, path, author, version, email, types', 'default', 'setOnEmpty' => true, 'value' => null),
			array('sourceid, source_name, update_timeout, retrieve_timeout, hostname, path, author, version, email, types, updated', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'weatherdatalayouts' => array(self::HAS_MANY, 'Weatherdatalayout', 'weathersourcesettings_sourceid'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'sourceid' => Yii::t('app', 'Sourceid'),
			'source_name' => Yii::t('app', 'Source Name'),
			'update_timeout' => Yii::t('app', 'Update Timeout'),
			'retrieve_timeout' => Yii::t('app', 'Retrieve Timeout'),
			'hostname' => Yii::t('app', 'Hostname'),
			'path' => Yii::t('app', 'Path'),
			'author' => Yii::t('app', 'Author'),
			'version' => Yii::t('app', 'Version'),
			'email' => Yii::t('app', 'Email'),
			'types' => Yii::t('app', 'Types'),
			'updated' => Yii::t('app', 'Updated'),
			'weatherdatalayouts' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('sourceid', $this->sourceid, true);
		$criteria->compare('source_name', $this->source_name, true);
		$criteria->compare('update_timeout', $this->update_timeout, true);
		$criteria->compare('retrieve_timeout', $this->retrieve_timeout, true);
		$criteria->compare('hostname', $this->hostname, true);
		$criteria->compare('path', $this->path, true);
		$criteria->compare('author', $this->author, true);
		$criteria->compare('version', $this->version, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('types', $this->types, true);
		$criteria->compare('updated', $this->updated, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}