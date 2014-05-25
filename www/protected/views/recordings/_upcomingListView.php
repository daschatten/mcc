<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        array(
            'name' => 'Recording.EncoderId',
            'header' => Yii::t('app', 'Tuner'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'StartTime',
            'header' => Yii::t('app', 'Time'),
            'value' => 'Yii::app()->dateFormatter->formatDateTime(strtotime($data->StartTime), "short", "short")',
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'Channel.ChannelName',
            'header' => Yii::t('app', 'Channel'),
        ),
        array(
            'name' => 'Title',
            'header' => Yii::t('app', 'Title'),
        ),
        array(
            'name' => 'SubTitle',
            'header' => Yii::t('app', 'Subtitle'),
        ),
        array(
            'name' => 'Recording.RecGroup',
            'header' => Yii::t('app', 'Group'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
    ),
));

?>

