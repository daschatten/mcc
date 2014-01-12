<?php

echo '<h3>'.Yii::t('app', 'Card input configuration').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $cardinputlist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'cardinputid',
        ),
        array(
            'name' => 'cardid',
        ),
        array(
            'name' => 'sourceid',
        ),
        array(
            'name' => 'inputname',
        ),
        array(
            'name' => 'startchan',
        ),
        array(
            'name' => 'displayname',
        ),
        array(
            'name' => 'recpriority',
        ),
        array(
            'name' => 'quicktune',
        ),
        array(
            'name' => 'schedorder',
        ),
        array(
            'name' => 'livetvorder',
        ),
    ),
));

?>
