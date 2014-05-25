<?php

echo '<h3>'.Yii::t('app', 'Storage groups').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $storagegrouplist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'id',
            'header' => Yii::t('app', 'ID'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'groupname',
            'header' => Yii::t('app', 'Group'),
        ),
        array(
            'name' => 'hostname',
            'header' => Yii::t('app', 'Host'),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'dirname',
            'header' => Yii::t('app', 'Directory'),
        ),
        array(
            'name' => 'recordingsCount',
            'header' => Yii::t('app', '# recordings'),
            'htmlOptions' => array('class' => 'tdright'),
            'headerHtmlOptions' => array('class' => 'tdright'),
        ),
        array(
            'header' => Yii::t('app', 'Used space'),
            'value' => 'ByteHelper::getString($data->spaceused)',
            'htmlOptions' => array('class' => 'tdright'),
            'headerHtmlOptions' => array('class' => 'tdright'),
        ),
    ),
));

?>
