<div id="recordingInfoMain">
    <h3><span id="recordingSubtitle"></span></h3>
    <table>
        <tr>
            <td><?= Yii::t('app', 'Date') ?></td><td><span id="recordingDate"></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Length (Min.)') ?></td><td><span id="recordingLength"></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Season/Episode') ?></td><td><span id="recordingEpisodeString"></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Recording group') ?></td><td><span id="recordingRecgroup"></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Rating') ?></td><td><span id="recordingRating"></span></td>
        </tr>
        <tr>
            <td><?= Yii::t('app', 'Filesize (GB)') ?></td><td><span id="recordingFilesize"></span></td>
        </tr>    
    </table>
</div>
<div id="recordingInfoImage">
    <img id="recordingImage" class="img-polaroid" src="" />
</div>
<div id="recordingInfoDescription">
    <span id="recordingDescription"></span>
</div>
