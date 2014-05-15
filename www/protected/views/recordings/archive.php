<?php

echo '<p>';
echo Yii::t('app', 'You can add recordings by clicking on the "archive" button in {Recordings->Recorded}.', 
    array(
        '{Recordings->Recorded}' => CHtml::link(
            Yii::t('app', 'Recordings')." -> ".Yii::t('app', 'Recorded'),
            $this->createUrl('Recordings/index')
        ),
    )
    );
echo '</p>';

echo '<p>';
echo Yii::t('app', 'To archive selected recordings copy the following commands and paste them in your shell. Make sure that source and destination directories are correct.');
echo '</p>';

if($isempty)
{
    echo '<i>'.Yii::t('app', 'No data found').'</i>';
    return;
}

echo "<pre>";

foreach($models as $model)
{
    $name = $model->title;
    
    if($model->episodeString != "")
    {
        $name = $name." - ".$model->episodeString;
    }
    
    if($model->subtitle != "")
    {
        $name = $name." - ".$model->subtitle;
    }
    
    echo Yii::app()->params['archive.method']." ".Yii::app()->params['archive.source.path'].$model->basename."' '".Yii::app()->params['archive.dest.path'].$name.".mpg'\n";
}

echo "</pre>";
