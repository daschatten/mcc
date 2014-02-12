<?php

echo $channelName;

$listdata = CHtml::listData(Channel::getVisibleChannelList(), 'channum', 'numname');
$guideurl = Yii::app()->createUrl('guide/weeksingleview');

$this->widget('ext.ESelect2.ESelect2',array(
    'model' => $searchModel,
    'attribute' => 'channum',
    'data'=>$listdata,
    'htmlOptions' => array(
        'id' => 'chanselect',
        'onChange' => "$(location).attr('href', function(index, attr){
            channum = $('#chanselect option:selected').val();
            return '$guideurl' + '/channum/' + channum;
        })",
        'style' => 'width: 250px;',
    ),
)); 

$this->widget('ext.efullcalendar.EFullCalendar', array(
    'id' => 'weeksingleview-calendar',
    'options' => array(
        'events' => $items,
        'defaultView' => 'agendaWeek',
//        'contentHeight' => 600,
        'firstDay' => 1,
        'eventMouseover' => new CJavaScriptExpression('calendarMouseover'),
        'eventMouseout' => new CJavaScriptExpression('calendarMouseout'),
        'eventClick' => new CJavaScriptExpression('calendarClick'),
    ), 
    'htmlOptions' => array(
        'style' => 'max-height:700px;'
    ),
));

$this->renderPartial('_detailpopup');

?>
