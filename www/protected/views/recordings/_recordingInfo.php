<?php
$modalcontent = $this->renderPartial('_recordingInfoTabs', array(), true);

$this->widget('bootstrap.widgets.TbModal', array(
    'id' => 'recordingDetailModal',
    'header' => '<span id="recordingTitle"></span>',
    'content' => $modalcontent,
    'htmlOptions' => array(
        'class' => 'modal-wide'
        ),
    )
);
