<?php

/**
 * This is the model base class for the table "recordedprogram".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Recordedprogram".
 *
 * Columns in table "recordedprogram" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $chanid
 * @property string $starttime
 * @property string $endtime
 * @property string $title
 * @property string $subtitle
 * @property string $description
 * @property string $category
 * @property string $category_type
 * @property string $airdate
 * @property double $stars
 * @property integer $previouslyshown
 * @property string $title_pronounce
 * @property integer $stereo
 * @property integer $subtitled
 * @property integer $hdtv
 * @property integer $closecaptioned
 * @property integer $partnumber
 * @property integer $parttotal
 * @property string $seriesid
 * @property string $originalairdate
 * @property string $showtype
 * @property string $colorcode
 * @property string $syndicatedepisodenumber
 * @property string $programid
 * @property string $manualid
 * @property integer $generic
 * @property integer $listingsource
 * @property integer $first
 * @property integer $last
 * @property string $audioprop
 * @property string $subtitletypes
 * @property string $videoprop
 *
 */
abstract class BaseRecordedprogram extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'recordedprogram';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Recordedprogram|Recordedprograms', $n);
	}

	public static function representingColumn() {
		return 'endtime';
	}

	public function rules() {
		return array(
			array('audioprop, subtitletypes, videoprop', 'required'),
			array('previouslyshown, stereo, subtitled, hdtv, closecaptioned, partnumber, parttotal, generic, listingsource, first, last', 'numerical', 'integerOnly'=>true),
			array('stars', 'numerical'),
			array('chanid, manualid', 'length', 'max'=>10),
			array('title, subtitle, title_pronounce', 'length', 'max'=>128),
			array('description', 'length', 'max'=>16000),
			array('category, category_type', 'length', 'max'=>64),
			array('airdate', 'length', 'max'=>4),
			array('seriesid, programid', 'length', 'max'=>40),
			array('showtype', 'length', 'max'=>30),
			array('colorcode, syndicatedepisodenumber', 'length', 'max'=>20),
			array('endtime, originalairdate', 'safe'),
			array('chanid, starttime, endtime, title, subtitle, description, category, category_type, airdate, stars, previouslyshown, title_pronounce, stereo, subtitled, hdtv, closecaptioned, partnumber, parttotal, seriesid, originalairdate, showtype, colorcode, syndicatedepisodenumber, programid, manualid, generic, listingsource, first, last', 'default', 'setOnEmpty' => true, 'value' => null),
			array('chanid, starttime, endtime, title, subtitle, description, category, category_type, airdate, stars, previouslyshown, title_pronounce, stereo, subtitled, hdtv, closecaptioned, partnumber, parttotal, seriesid, originalairdate, showtype, colorcode, syndicatedepisodenumber, programid, manualid, generic, listingsource, first, last, audioprop, subtitletypes, videoprop', 'safe', 'on'=>'search'),
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
			'endtime' => Yii::t('app', 'Endtime'),
			'title' => Yii::t('app', 'Title'),
			'subtitle' => Yii::t('app', 'Subtitle'),
			'description' => Yii::t('app', 'Description'),
			'category' => Yii::t('app', 'Category'),
			'category_type' => Yii::t('app', 'Category Type'),
			'airdate' => Yii::t('app', 'Airdate'),
			'stars' => Yii::t('app', 'Stars'),
			'previouslyshown' => Yii::t('app', 'Previouslyshown'),
			'title_pronounce' => Yii::t('app', 'Title Pronounce'),
			'stereo' => Yii::t('app', 'Stereo'),
			'subtitled' => Yii::t('app', 'Subtitled'),
			'hdtv' => Yii::t('app', 'Hdtv'),
			'closecaptioned' => Yii::t('app', 'Closecaptioned'),
			'partnumber' => Yii::t('app', 'Partnumber'),
			'parttotal' => Yii::t('app', 'Parttotal'),
			'seriesid' => Yii::t('app', 'Seriesid'),
			'originalairdate' => Yii::t('app', 'Originalairdate'),
			'showtype' => Yii::t('app', 'Showtype'),
			'colorcode' => Yii::t('app', 'Colorcode'),
			'syndicatedepisodenumber' => Yii::t('app', 'Syndicatedepisodenumber'),
			'programid' => Yii::t('app', 'Programid'),
			'manualid' => Yii::t('app', 'Manualid'),
			'generic' => Yii::t('app', 'Generic'),
			'listingsource' => Yii::t('app', 'Listingsource'),
			'first' => Yii::t('app', 'First'),
			'last' => Yii::t('app', 'Last'),
			'audioprop' => Yii::t('app', 'Audioprop'),
			'subtitletypes' => Yii::t('app', 'Subtitletypes'),
			'videoprop' => Yii::t('app', 'Videoprop'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('chanid', $this->chanid, true);
		$criteria->compare('starttime', $this->starttime, true);
		$criteria->compare('endtime', $this->endtime, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('subtitle', $this->subtitle, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('category', $this->category, true);
		$criteria->compare('category_type', $this->category_type, true);
		$criteria->compare('airdate', $this->airdate, true);
		$criteria->compare('stars', $this->stars);
		$criteria->compare('previouslyshown', $this->previouslyshown);
		$criteria->compare('title_pronounce', $this->title_pronounce, true);
		$criteria->compare('stereo', $this->stereo);
		$criteria->compare('subtitled', $this->subtitled);
		$criteria->compare('hdtv', $this->hdtv);
		$criteria->compare('closecaptioned', $this->closecaptioned);
		$criteria->compare('partnumber', $this->partnumber);
		$criteria->compare('parttotal', $this->parttotal);
		$criteria->compare('seriesid', $this->seriesid, true);
		$criteria->compare('originalairdate', $this->originalairdate, true);
		$criteria->compare('showtype', $this->showtype, true);
		$criteria->compare('colorcode', $this->colorcode, true);
		$criteria->compare('syndicatedepisodenumber', $this->syndicatedepisodenumber, true);
		$criteria->compare('programid', $this->programid, true);
		$criteria->compare('manualid', $this->manualid, true);
		$criteria->compare('generic', $this->generic);
		$criteria->compare('listingsource', $this->listingsource);
		$criteria->compare('first', $this->first);
		$criteria->compare('last', $this->last);
		$criteria->compare('audioprop', $this->audioprop, true);
		$criteria->compare('subtitletypes', $this->subtitletypes, true);
		$criteria->compare('videoprop', $this->videoprop, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}