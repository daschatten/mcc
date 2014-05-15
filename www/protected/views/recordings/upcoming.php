<?php 

$this->breadcrumbs=array(
	Yii::t('app', 'Upcoming'),
);

$this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'upcoming-tabs',
    'tabs' => array(
        array(
            'label' => Yii::t('app', 'List view'), 
            'content' => $this->renderPartial("_upcomingListView", array('dataProvider' => $dataProvider), true), 
            'active' => true,
        ),
        array(
            'label' => Yii::t('app', 'Calendar view'), 
            'content' => $this->renderPartial("_upcomingCalendarView", array('dataProvider' => $dataProvider), true),
        ),
    ),
    'onShown' => "function(){
                $('#upcoming-calendar').fullCalendar('render');
            }
    ",

));
?>
