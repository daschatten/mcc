<?php

echo '<h3>'.Yii::t('app', 'Card input configuration').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $cardinputlist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'cardinputid',
            'header' => Yii::t('app', 'Card input'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'cardid',
            'header' => Yii::t('app', 'Card'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'sourceid',
            'header' => Yii::t('app', 'Source'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'inputname',
            'header' => Yii::t('app', 'Input name'),
        ),
        array(
            'name' => 'startchan',
            'header' => Yii::t('app', 'Starting on channel'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'displayname',
            'header' => Yii::t('app', 'Name'),
        ),
        array(
            'name' => 'recpriority',
            'header' => Yii::t('app', 'Recording priority'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'quicktune',
            'header' => Yii::t('app', 'Quicktune'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'schedorder',
            'header' => Yii::t('app', 'Scheduling order'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'livetvorder',
            'header' => Yii::t('app', 'Live tv order'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
    ),
));

?>
