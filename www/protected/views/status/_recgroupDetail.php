<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $dataProvider,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'title',
            'header' => Yii::t('app', 'Title'),
        ),
        array(
            'name' => 'episodeCount',
            'header' => Yii::t('app', '# episodes'),
            'htmlOptions' => array('class' => 'tdright'),
            'headerHtmlOptions' => array('class' => 'tdright'),
        ),
        array(
            'header' => Yii::t('app', 'Used space'),
            'value' => 'ByteHelper::getString($data->filesize, "GB")',
            'htmlOptions' => array('class' => 'tdright'),
            'headerHtmlOptions' => array('class' => 'tdright'),
        ),
    ),
));

?>
