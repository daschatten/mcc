<?php

echo '<h3>'.Yii::t('app', 'Tuner configuration').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $capturecardlist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'cardid',
            'header' => Yii::t('app', 'Card'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'videodevice',
            'header' => Yii::t('app', 'Device'),
        ),
        array(
            'name' => 'cardtype',
            'header' => Yii::t('app', 'Type'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'hostname',
            'header' => Yii::t('app', 'Host'),
        ),
        array(
            'name' => 'dvb_tuning_delay',
            'header' => Yii::t('app', 'DVB tuning delay'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'dvb_eitscan',
            'header' => Yii::t('app', 'DVB EIT scan'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
    ),
));

?>
