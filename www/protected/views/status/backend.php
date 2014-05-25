<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Backend'),
);
?>

<h3><?= Yii::t('app', 'MythTV general information') ?></h3>
    <ul>
        <li><?php echo Yii::t('app', 'Version').": ".$backendstatus->body{'version'} ?></li>
        <li><?php echo Yii::t('app', 'Protocol version').": ".$backendstatus->body{'protoVer'} ?></li>
        <li><?php echo Yii::t('app', 'Date').": ".$backendstatus->body{'ISODate'} ?></li>
    </ul>

<h3><?= Yii::t('app', 'MythTV server load') ?></h3>
    <ul>
        <li><?php echo Yii::t('app', '1 Minute').": ".round((float)str_replace(",", ".", $backendstatus->body->MachineInfo->Load{'avg1'}), 2) ?></li>
        <li><?php echo Yii::t('app', '5 Minutes').": ".round((float) str_replace(",", ".", $backendstatus->body->MachineInfo->Load{'avg2'}), 2) ?></li>
        <li><?php echo Yii::t('app', '15 Minutes').": ".round((float) str_replace(",", ".", $backendstatus->body->MachineInfo->Load{'avg3'}), 2) ?></li>
    </ul>

<h3><?= Yii::t('app', 'EPG information') ?></h3>
    <ul>
        <li><?php echo Yii::t('app', 'Last status').": ".$backendstatus->body->MachineInfo->Guide{'status'} ?></li>
        <li><?php echo Yii::t('app', 'Start').": ".$backendstatus->body->MachineInfo->Guide{'start'} ?></li>
        <li><?php echo Yii::t('app', 'End').": ".$backendstatus->body->MachineInfo->Guide{'end'} ?></li>
        <li><?php echo Yii::t('app', 'EPG available until').": ".$backendstatus->body->MachineInfo->Guide{'guideThru'} ?></li>
        <li><?php echo Yii::t('app', 'Available days').": ".$backendstatus->body->MachineInfo->Guide{'guideDays'} ?></li>
    </ul>
