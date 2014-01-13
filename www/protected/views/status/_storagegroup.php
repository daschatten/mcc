<?php

echo '<h3>'.Yii::t('app', 'Storagegroups').'</h3>';

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $storagegrouplist,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'id',
        ),
        array(
            'name' => 'groupname',
        ),
        array(
            'name' => 'hostname',
        ),
        array(
            'name' => 'dirname',
        ),
        array(
            'name' => 'recordingsCount',
        ),
        array(
            'header' => Yii::t('app', 'Used space'),
            'value' => 'ByteHelper::getString($data->spaceused)',
        ),
    ),
));

?>
