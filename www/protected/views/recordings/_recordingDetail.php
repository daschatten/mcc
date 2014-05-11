<?= CHtml::link(Yii::t('app', 'back'), array('Recordings/index')) ?>

<div id="recordingInfoMain">
    <h3><span id="recordingSubtitle"></span></h3>
    <table>
        <tr>
            <td><?= Yii::t('app', 'Date') ?></td><td><span id="recordingDate"><?= $model->starttime ?></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Length (Min.)') ?></td><td><span id="recordingLength"><?= $model->length ?></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Season/Episode') ?></td><td><span id="recordingEpisodeString"><?= $model->episodeString ?></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Recording group') ?></td><td><span id="recordingRecgroup"><?= $model->recgroup ?></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Rating') ?></td><td><span id="recordingRating"><?= $model->stars ?></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Filesize (Gb)') ?></td><td><span id="recordingFilesize"><?= $model->filesizeGb ?></span></td>
        </tr>    
    </table>
</div>
<div id="recordingInfoImage">
    <img id="recordingImage" class="img-polaroid" src="<?= Yii::app()->params['mediaUrl'].'/'.$model->basename.'.png' ?>" />
</div>
<div id="recordingInfoDescription">
    <span id="recordingDescription"><?= $model->description ?></span>
</div>
