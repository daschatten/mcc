<?php

/**
 * This is the model base class for the table "music_songs".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MusicSongs".
 *
 * Columns in table "music_songs" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $song_id
 * @property string $filename
 * @property string $name
 * @property integer $track
 * @property string $artist_id
 * @property string $album_id
 * @property string $genre_id
 * @property integer $year
 * @property string $length
 * @property string $numplays
 * @property integer $rating
 * @property string $lastplay
 * @property string $date_entered
 * @property string $date_modified
 * @property string $format
 * @property string $mythdigest
 * @property string $size
 * @property string $description
 * @property string $comment
 * @property integer $disc_count
 * @property integer $disc_number
 * @property integer $track_count
 * @property string $start_time
 * @property string $stop_time
 * @property string $eq_preset
 * @property integer $relative_volume
 * @property string $sample_rate
 * @property string $bitrate
 * @property integer $bpm
 * @property integer $directory_id
 *
 */
abstract class BaseMusicSongs extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'music_songs';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'MusicSongs|MusicSongs', $n);
	}

	public static function representingColumn() {
		return 'filename';
	}

	public function rules() {
		return array(
			array('filename', 'required'),
			array('track, year, rating, disc_count, disc_number, track_count, relative_volume, bpm, directory_id', 'numerical', 'integerOnly'=>true),
			array('name, mythdigest, description, comment, eq_preset', 'length', 'max'=>255),
			array('artist_id, album_id, genre_id, length, numplays', 'length', 'max'=>11),
			array('format', 'length', 'max'=>4),
			array('size', 'length', 'max'=>20),
			array('start_time, stop_time, sample_rate, bitrate', 'length', 'max'=>10),
			array('lastplay, date_entered, date_modified', 'safe'),
			array('name, track, artist_id, album_id, genre_id, year, length, numplays, rating, lastplay, date_entered, date_modified, format, mythdigest, size, description, comment, disc_count, disc_number, track_count, start_time, stop_time, eq_preset, relative_volume, sample_rate, bitrate, bpm, directory_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('song_id, filename, name, track, artist_id, album_id, genre_id, year, length, numplays, rating, lastplay, date_entered, date_modified, format, mythdigest, size, description, comment, disc_count, disc_number, track_count, start_time, stop_time, eq_preset, relative_volume, sample_rate, bitrate, bpm, directory_id', 'safe', 'on'=>'search'),
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
			'song_id' => Yii::t('app', 'Song'),
			'filename' => Yii::t('app', 'Filename'),
			'name' => Yii::t('app', 'Name'),
			'track' => Yii::t('app', 'Track'),
			'artist_id' => Yii::t('app', 'Artist'),
			'album_id' => Yii::t('app', 'Album'),
			'genre_id' => Yii::t('app', 'Genre'),
			'year' => Yii::t('app', 'Year'),
			'length' => Yii::t('app', 'Length'),
			'numplays' => Yii::t('app', 'Numplays'),
			'rating' => Yii::t('app', 'Rating'),
			'lastplay' => Yii::t('app', 'Lastplay'),
			'date_entered' => Yii::t('app', 'Date Entered'),
			'date_modified' => Yii::t('app', 'Date Modified'),
			'format' => Yii::t('app', 'Format'),
			'mythdigest' => Yii::t('app', 'Mythdigest'),
			'size' => Yii::t('app', 'Size'),
			'description' => Yii::t('app', 'Description'),
			'comment' => Yii::t('app', 'Comment'),
			'disc_count' => Yii::t('app', 'Disc Count'),
			'disc_number' => Yii::t('app', 'Disc Number'),
			'track_count' => Yii::t('app', 'Track Count'),
			'start_time' => Yii::t('app', 'Start Time'),
			'stop_time' => Yii::t('app', 'Stop Time'),
			'eq_preset' => Yii::t('app', 'Eq Preset'),
			'relative_volume' => Yii::t('app', 'Relative Volume'),
			'sample_rate' => Yii::t('app', 'Sample Rate'),
			'bitrate' => Yii::t('app', 'Bitrate'),
			'bpm' => Yii::t('app', 'Bpm'),
			'directory_id' => Yii::t('app', 'Directory'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('song_id', $this->song_id, true);
		$criteria->compare('filename', $this->filename, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('track', $this->track);
		$criteria->compare('artist_id', $this->artist_id, true);
		$criteria->compare('album_id', $this->album_id, true);
		$criteria->compare('genre_id', $this->genre_id, true);
		$criteria->compare('year', $this->year);
		$criteria->compare('length', $this->length, true);
		$criteria->compare('numplays', $this->numplays, true);
		$criteria->compare('rating', $this->rating);
		$criteria->compare('lastplay', $this->lastplay, true);
		$criteria->compare('date_entered', $this->date_entered, true);
		$criteria->compare('date_modified', $this->date_modified, true);
		$criteria->compare('format', $this->format, true);
		$criteria->compare('mythdigest', $this->mythdigest, true);
		$criteria->compare('size', $this->size, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('comment', $this->comment, true);
		$criteria->compare('disc_count', $this->disc_count);
		$criteria->compare('disc_number', $this->disc_number);
		$criteria->compare('track_count', $this->track_count);
		$criteria->compare('start_time', $this->start_time, true);
		$criteria->compare('stop_time', $this->stop_time, true);
		$criteria->compare('eq_preset', $this->eq_preset, true);
		$criteria->compare('relative_volume', $this->relative_volume);
		$criteria->compare('sample_rate', $this->sample_rate, true);
		$criteria->compare('bitrate', $this->bitrate, true);
		$criteria->compare('bpm', $this->bpm);
		$criteria->compare('directory_id', $this->directory_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}