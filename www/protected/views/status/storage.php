<?php

$this->breadcrumbs=array(
	Yii::t('app', 'Storage'),
);

$this->renderPartial('_storagegroup', array('storagegrouplist' => $storagegrouplist));
$this->renderPartial('_recgroup', array(
    'recgrouplist' => $recgrouplist,
    'recgroupDataproviderList' => $recgroupDataproviderList,
    'recgroupSummary' => $recgroupSummary,
));

?>
