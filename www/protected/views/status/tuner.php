<?php

echo '<h3>'.Yii::t('app', 'Tuner status').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $dataProvider,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'Id',
        ),
        array(
            'name' => 'State',
            'value' => 'MythtvEnum::getTvString($data->State)',
        ),
        array(
            'name' => 'Recording.Title',
            'header' => Yii::t('app', 'Title'),
        ),
        array(
            'name' => 'Recording.EndTime',
            'header' => Yii::t('app', 'End'),
        ),
    ),
));


?>
