<?php
/* @var $this RecordingsController */

$this->breadcrumbs=array(
	'Recordings',
);

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $recorded->search(),
    'filter' => $recorded,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'starttime',
            'header' => Yii::t('app', 'Date'),
            'filter' => false,
        ),
        array(
            'name' => 'chanid',
        ),
        array(
            'name' => 'title',
        ),
        array(
            'name' => 'subtitle',
        ),
        array(
            'name' => 'recgroup',
            'filter' => MRecorded::getRecgroups(),
        ),
        array(
            'name' => 'FilesizeGb',
            'filter' => false,
            'header' => 'Size (GB)',
        ),
    ),
));

?>
