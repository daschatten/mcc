<?php

$tablist = array();

$tablist[] = array(
    'label' => 'Summary', 
    'content' => $this->renderPartial('_recgroupSummary', array(
        'dataProvider' => $recgroupSummary,
    ), true), 
    'active' => true
);


foreach($recgrouplist as $recgroup)
{
    $tablist[] = array(
        'label' => $recgroup, 
        'content' => $this->renderPartial('_recgroupDetail', array(
            'dataProvider' => $recgroupDataproviderList[$recgroup]
        ), true)
    );
}

$this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => $tablist,
));

?>
