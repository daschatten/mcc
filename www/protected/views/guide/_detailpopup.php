<?php
$modalcontent = $this->renderPartial('_detailContent', array(), true);

$this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'programDetailModal',
    'header' => '<span id="programTitle"></span>',
    'content' => $modalcontent,
    'htmlOptions' => array(
        'class' => 'modal-wide'
        ),
    )
);
