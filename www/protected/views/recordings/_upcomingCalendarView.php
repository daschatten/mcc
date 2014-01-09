<?php
$this->widget('ext.efullcalendar.EFullCalendar', array(
    'id' => 'upcoming-calendar',
    'options' => array(
        'events' => Yii::app()->createUrl('recordings/upcomingFeed'),
        'defaultView' => 'basicWeek',
        'contentHeight' => 600,
        'firstDay' => 1,
        'eventMouseover' => new CJavaScriptExpression("calendarMouseover"),
        'eventMouseout' => new CJavaScriptExpression("calendarMouseout"),
//        'eventRender' => new CJavaScriptExpression("calendarEventrender"),
//        'eventMouseover' => 'calendarOnHover(event, jsEvent, view)',
//        'eventMouseover' => 'eventMouseover',
//        'eventMouseover' => "function(event, jsEvent, view){alert('muh');}",
//        'eventMouseover' => "function(event, jsEvent, view) {
//            $('.fc-event-inner', this).append('<div id=\"'+event.id+'\" class=\"hover-end\">'+$.fullCalendar.formatDate(event.end, 'h:mmt')+'</div>');
//        }",
//        'eventMouseout' => "function(event, jsEvent, view) {
//            $('#'+event.id).remove();
//        }",
    ), 
    'htmlOptions' => array(
        'style' => 'max-height:700px;'
    ),
));
?>
