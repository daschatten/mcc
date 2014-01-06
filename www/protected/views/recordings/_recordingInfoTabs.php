<?php 

$recordingDetail = $this->renderPartial('_recordingInfoTabDetail', array(), true);

$this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => array(
        array('label' => Yii::t('app', 'Detail'), 'content' => $recordingDetail, 'active' => true),
        array('label' => Yii::t('app', 'Episode Guide'), 'content' => '<div id="episodeGuide"></div>'),
    ),
)); ?>
