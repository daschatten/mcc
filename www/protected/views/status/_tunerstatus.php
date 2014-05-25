<?php

echo '<h3>'.Yii::t('app', 'Tuner status').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $encoderlist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'Id',
            'header' => Yii::t('app', 'Tuner'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'State',
            'header' => Yii::t('app', 'State'),
            'value' => 'MythtvEnum::getTvString($data->State)',
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'Recording.Channel.ChannelName',
            'header' => Yii::t('app', 'Channel'),
        ),
        array(
            'name' => 'Recording.Title',
            'header' => Yii::t('app', 'Title'),
        ),
        array(
            'name' => 'Recording.SubTitle',
            'header' => Yii::t('app', 'Subtitle'),
        ),
        array(
            'name' => 'Recording.EndTime',
            'header' => Yii::t('app', 'End'),
        ),
    ),
));

?>
