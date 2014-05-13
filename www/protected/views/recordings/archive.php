<?php

if($isempty)
{
    echo "No data found";
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
    
    echo "rsync -avz '".Yii::app()->params['archive.source.path'].$model->basename."' '".Yii::app()->params['archive.dest.path'].$name.".mpeg'\n";
}

echo "</pre>";
