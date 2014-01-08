<?php
$this->widget('ext.efullcalendar.EFullCalendar', array(
    'id' => 'upcoming-calendar',
    'options' => array(
        'events' => Yii::app()->createUrl('recordings/upcomingFeed'),
        'defaultView' => 'basicWeek',
        'contentHeight' => 600,
        'firstDay' => 1,
    ), 
    'htmlOptions' => array(
        'style' => 'max-height:700px;'
    ),
));
?>
