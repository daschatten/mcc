<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;


echo '<h2>'.Yii::t('app', 'Backend status').'</h2>';
echo '<ul>';
echo '<li>'.Yii::t('app', 'Version').": ".$data['backendstatus']->body{'version'}.'</li>';
echo '<li>'.Yii::t('app', 'Date').": ".$data['backendstatus']->body{'ISODate'}.'</li>';
echo '<li>'.Yii::t('app', 'Load 1 Minute').": ".round((float)str_replace(",", ".", $data['backendstatus']->body->MachineInfo->Load{'avg1'}), 2).'</li>';
echo '<li>'.Yii::t('app', 'Load 5 Minutes').": ".round((float)str_replace(",", ".", $data['backendstatus']->body->MachineInfo->Load{'avg5'}), 2).'</li>';
echo '<li>'.Yii::t('app', 'Load 15 Minutes').": ".round((float)str_replace(",", ".", $data['backendstatus']->body->MachineInfo->Load{'avg15'}), 2).'</li>';
echo '</ul>';

echo '<h2>'.Yii::t('app', 'Tuner status').'</h2>';

echo '<ul>';
foreach($data['encoderlist']->EncoderList->Encoders as $encoder)
{
    echo '<li>'.MythtvEnum::getTvString($encoder->State).' '.$encoder->Recording->Title.'</li>';
}
echo '</ul>';

echo '<h2>'.Yii::t('app', 'Last recorded').'</h2>';
echo '<ul>';
foreach($data['recordedlist'] as $recorded)
{
    $name = $recorded->title;
    
    if($recorded->episodeString != '')
    {
        $name = $name.' - '.$recorded->episodeString;
    }
    
    if($recorded->subtitle != '')
    {
        $name = $name.' - '.$recorded->subtitle;
    }
    
    echo '<li>'.$name.'</li>';
}
echo '</ul>';

echo '<h2>'.Yii::t('app', 'Upcoming recordings').'</h2>';
echo '<ul>';
foreach($data['upcominglist']->Programs->Program as $upcoming)
{    
    $name = $upcoming->Title;
    
    if($upcoming->SubTitle != '')
    {
        $name = $name.' - '.$upcoming->SubTitle;
    }
    
    echo '<li>'.$name.'</li>';
}
echo '</ul>';

