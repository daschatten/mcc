<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        'Recording.EncoderId',
        array(
            'name' => 'StartTime',
            'value' => 'Yii::app()->dateFormatter->formatDateTime(strtotime($data->StartTime), "short", "short")',
        ),
        'Channel.ChannelName',
        'Title',
        'SubTitle',
        'Recording.RecGroup',
    ),
));

?>

