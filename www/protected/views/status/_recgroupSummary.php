<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $dataProvider,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'recgroup',
            'header' => Yii::t('app', 'Group'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'episodeCount',
            'header' => Yii::t('app', '# recordings'),
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
