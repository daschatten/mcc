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
echo Yii::t('app', 'To archive selected recordings copy the following commands and paste them in your shell. Make sure that source and destination directories are correct. You can set method and paths below and default values in config file.');
echo '</p>';

echo '<p>';
echo CHtml::beginForm('', 'get');
echo CHtml::label(Yii::t('app', 'Method'), 'method');
echo CHtml::textField('method', $data['method']);
echo CHtml::label(Yii::t('app', 'Source path'), 'src');
echo CHtml::textField('src', $data['src']);
echo CHtml::label(Yii::t('app', 'Destination path'), 'dest');
echo CHtml::textField('dest', $data['dest']);
echo CHtml::submitButton(Yii::t('app', 'Set'));
echo CHtml::endForm();
echo '</p>';

echo '<p>';
echo CHtml::link(Yii::t('app', 'Clear archive list'), Yii::app()->createUrl('Recordings/clearArchive'));
echo '</p>';

if($data['isempty'])
{
    echo '<i>'.Yii::t('app', 'No data found').'</i>';
    return;
}

echo "<pre>";

foreach($data['models'] as $model)
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
    
    echo $data['method']." '".$data['src'].$model->basename."' '".$data['dest'].$name.".mpg'\n";
}

echo "</pre>";

if(sizeof($data['errors']) > 0)
{
    echo '<strong>'.Yii::t('app', 'The following items generated errors').'</strong>';
    echo '<ul>';
    foreach($data['errors'] as $error)
    {
        echo '<li>'.$error.'</li>';
    }
    echo '</ul>';
}
