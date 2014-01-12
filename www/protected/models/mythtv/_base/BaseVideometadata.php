<?php

/**
 * This is the model base class for the table "videometadata".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Videometadata".
 *
 * Columns in table "videometadata" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $intid
 * @property string $title
 * @property string $subtitle
 * @property string $tagline
 * @property string $director
 * @property string $studio
 * @property string $plot
 * @property string $rating
 * @property string $inetref
 * @property integer $collectionref
 * @property string $homepage
 * @property string $year
 * @property string $releasedate
 * @property double $userrating
 * @property string $length
 * @property integer $playcount
 * @property integer $season
 * @property integer $episode
 * @property string $showlevel
 * @property string $filename
 * @property string $hash
 * @property string $coverfile
 * @property integer $childid
 * @property integer $browse
 * @property integer $watched
 * @property integer $processed
 * @property string $playcommand
 * @property string $category
 * @property string $trailer
 * @property string $host
 * @property string $screenshot
 * @property string $banner
 * @property string $fanart
 * @property string $insertdate
 * @property string $contenttype
 *
 */
abstract class BaseVideometadata extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'videometadata';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Videometadata|Videometadatas', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, subtitle, director, rating, inetref, homepage, year, releasedate, userrating, length, showlevel, filename, hash, coverfile, host', 'required'),
			array('collectionref, playcount, season, episode, childid, browse, watched, processed', 'numerical', 'integerOnly'=>true),
			array('userrating', 'numerical'),
			array('title, director, studio, rating, hash', 'length', 'max'=>128),
			array('tagline, inetref, playcommand', 'length', 'max'=>255),
			array('year, length, showlevel, category', 'length', 'max'=>10),
			array('plot, trailer, screenshot, banner, fanart, insertdate, contenttype', 'safe'),
			array('tagline, studio, plot, collectionref, playcount, season, episode, childid, browse, watched, processed, playcommand, category, trailer, screenshot, banner, fanart, insertdate, contenttype', 'default', 'setOnEmpty' => true, 'value' => null),
			array('intid, title, subtitle, tagline, director, studio, plot, rating, inetref, collectionref, homepage, year, releasedate, userrating, length, playcount, season, episode, showlevel, filename, hash, coverfile, childid, browse, watched, processed, playcommand, category, trailer, host, screenshot, banner, fanart, insertdate, contenttype', 'safe', 'on'=>'search'),
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
			'intid' => Yii::t('app', 'Intid'),
			'title' => Yii::t('app', 'Title'),
			'subtitle' => Yii::t('app', 'Subtitle'),
			'tagline' => Yii::t('app', 'Tagline'),
			'director' => Yii::t('app', 'Director'),
			'studio' => Yii::t('app', 'Studio'),
			'plot' => Yii::t('app', 'Plot'),
			'rating' => Yii::t('app', 'Rating'),
			'inetref' => Yii::t('app', 'Inetref'),
			'collectionref' => Yii::t('app', 'Collectionref'),
			'homepage' => Yii::t('app', 'Homepage'),
			'year' => Yii::t('app', 'Year'),
			'releasedate' => Yii::t('app', 'Releasedate'),
			'userrating' => Yii::t('app', 'Userrating'),
			'length' => Yii::t('app', 'Length'),
			'playcount' => Yii::t('app', 'Playcount'),
			'season' => Yii::t('app', 'Season'),
			'episode' => Yii::t('app', 'Episode'),
			'showlevel' => Yii::t('app', 'Showlevel'),
			'filename' => Yii::t('app', 'Filename'),
			'hash' => Yii::t('app', 'Hash'),
			'coverfile' => Yii::t('app', 'Coverfile'),
			'childid' => Yii::t('app', 'Childid'),
			'browse' => Yii::t('app', 'Browse'),
			'watched' => Yii::t('app', 'Watched'),
			'processed' => Yii::t('app', 'Processed'),
			'playcommand' => Yii::t('app', 'Playcommand'),
			'category' => Yii::t('app', 'Category'),
			'trailer' => Yii::t('app', 'Trailer'),
			'host' => Yii::t('app', 'Host'),
			'screenshot' => Yii::t('app', 'Screenshot'),
			'banner' => Yii::t('app', 'Banner'),
			'fanart' => Yii::t('app', 'Fanart'),
			'insertdate' => Yii::t('app', 'Insertdate'),
			'contenttype' => Yii::t('app', 'Contenttype'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('intid', $this->intid, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('subtitle', $this->subtitle, true);
		$criteria->compare('tagline', $this->tagline, true);
		$criteria->compare('director', $this->director, true);
		$criteria->compare('studio', $this->studio, true);
		$criteria->compare('plot', $this->plot, true);
		$criteria->compare('rating', $this->rating, true);
		$criteria->compare('inetref', $this->inetref, true);
		$criteria->compare('collectionref', $this->collectionref);
		$criteria->compare('homepage', $this->homepage, true);
		$criteria->compare('year', $this->year, true);
		$criteria->compare('releasedate', $this->releasedate, true);
		$criteria->compare('userrating', $this->userrating);
		$criteria->compare('length', $this->length, true);
		$criteria->compare('playcount', $this->playcount);
		$criteria->compare('season', $this->season);
		$criteria->compare('episode', $this->episode);
		$criteria->compare('showlevel', $this->showlevel, true);
		$criteria->compare('filename', $this->filename, true);
		$criteria->compare('hash', $this->hash, true);
		$criteria->compare('coverfile', $this->coverfile, true);
		$criteria->compare('childid', $this->childid);
		$criteria->compare('browse', $this->browse);
		$criteria->compare('watched', $this->watched);
		$criteria->compare('processed', $this->processed);
		$criteria->compare('playcommand', $this->playcommand, true);
		$criteria->compare('category', $this->category, true);
		$criteria->compare('trailer', $this->trailer, true);
		$criteria->compare('host', $this->host, true);
		$criteria->compare('screenshot', $this->screenshot, true);
		$criteria->compare('banner', $this->banner, true);
		$criteria->compare('fanart', $this->fanart, true);
		$criteria->compare('insertdate', $this->insertdate, true);
		$criteria->compare('contenttype', $this->contenttype, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}