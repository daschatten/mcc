<h3>MythTV general information</h3>
    <ul>
        <li><?php echo Yii::t('app', 'Version').": ".$backendstatus->body{'version'} ?></li>
        <li><?php echo Yii::t('app', 'Protocol version').": ".$backendstatus->body{'protoVer'} ?></li>
        <li><?php echo Yii::t('app', 'Date').": ".$backendstatus->body{'ISODate'} ?></li>
    </ul>

<h3>MythTV server load</h3>
    <ul>
        <li><?php echo Yii::t('app', '1 Minute').": ".$backendstatus->body->MachineInfo->Load{'avg1'} ?></li>
        <li><?php echo Yii::t('app', '5 Minutes').": ".$backendstatus->body->MachineInfo->Load{'avg2'} ?></li>
        <li><?php echo Yii::t('app', '15 Minutes').": ".$backendstatus->body->MachineInfo->Load{'avg3'} ?></li>
    </ul>

<h3>EPG information</h3>
    <ul>
        <li><?php echo Yii::t('app', 'Last status').": ".$backendstatus->body->MachineInfo->Guide{'status'} ?></li>
        <li><?php echo Yii::t('app', 'Start').": ".$backendstatus->body->MachineInfo->Guide{'start'} ?></li>
        <li><?php echo Yii::t('app', 'End').": ".$backendstatus->body->MachineInfo->Guide{'end'} ?></li>
        <li><?php echo Yii::t('app', 'EPG available until').": ".$backendstatus->body->MachineInfo->Guide{'guideThru'} ?></li>
        <li><?php echo Yii::t('app', 'Available days').": ".$backendstatus->body->MachineInfo->Guide{'guideDays'} ?></li>
    </ul>