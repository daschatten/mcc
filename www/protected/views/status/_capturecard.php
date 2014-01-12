<?php

echo '<h3>'.Yii::t('app', 'Tuner configuration').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $capturecardlist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'cardid',
        ),
        array(
            'name' => 'videodevice',
        ),
        array(
            'name' => 'cardtype',
        ),
        array(
            'name' => 'hostname',
        ),
        array(
            'name' => 'dvb_tuning_delay',
        ),
        array(
            'name' => 'dvb_eitscan',
        ),
    ),
));

?>
