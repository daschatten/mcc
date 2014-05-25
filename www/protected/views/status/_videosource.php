<?php

echo '<h3>'.Yii::t('app', 'Video source configuration').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $videosourcelist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'sourceid',
            'header' => Yii::t('app', 'Source'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'name',
            'header' => Yii::t('app', 'Name'),
        ),
        array(
            'name' => 'xmltvgrabber',
            'header' => Yii::t('app', 'XMLTV grabber'),
        ),
        array(
            'name' => 'useeit',
            'header' => Yii::t('app', 'Use EIT'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'header' => Yii::t('app', 'Multiplexes (visible/all)'),
            'value' => '$data->visibleMultiplexes." / ".$data->multiplexes',
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'header' => Yii::t('app', 'Channels (visible/all)'),
            'value' => '$data->visibleChannels." / ".$data->channels',
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
    ),
));

?>
