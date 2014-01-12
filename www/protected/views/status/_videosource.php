<?php

echo '<h3>'.Yii::t('app', 'Video source configuration').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $videosourcelist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'sourceid',
        ),
        array(
            'name' => 'name',
        ),
        array(
            'name' => 'xmltvgrabber',
        ),
        array(
            'name' => 'useeit',
        ),
    ),
));

?>
