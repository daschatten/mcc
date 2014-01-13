<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $dataProvider,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'recgroup',
        ),
        array(
            'name' => 'episodeCount',
        ),
        array(
            'header' => Yii::t('app', 'Used space'),
            'value' => 'ByteHelper::getString($data->filesize, "GB")',
        ),
    ),
));

?>
