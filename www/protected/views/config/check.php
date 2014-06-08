<?php

echo '<p>';
echo Yii::t('app', 'The config items below show you if your application is set up properly:');

echo '<div class="legend-color config_value_set">&nbsp;</div>';
echo '<div>'.Yii::t('app', 'Green means that you have set this config item.').'</div>';
echo '<div class="clear"></div>';

echo '<div class="legend-color config_value_notset">&nbsp;</div>';
echo '<div>'.Yii::t('app', 'Yellow means that you have not set this config item and the default value is used.').'</div>';
echo '<div class="clear"></div>';

echo '<div class="legend-color config_value_required">&nbsp;</div>';
echo '<div>'.Yii::t('app', 'Red means that you have not set this config item, but the item is required for the application to work properly.').'</div>';
echo '<div class="clear"></div>';

echo '</p>';

echo '<hr/>';

echo CHtml::beginForm();

foreach($items as $key => $item)
{
    if($key === 'recordItems')
        continue;

    $value = (in_array($key, Yii::app()->params->keys)) ? Yii::app()->params[$key] : '';
    $notice = '';
    $class = 'config_value_notset';

    if($value !== $item['default'] AND $value !== '')
    {
        $class = 'config_value_set';
    }

    if($item['required'])
    {
        $notice = Yii::t('app', 'This config item has to be set to a custom value!').' ';

        if($value === $item['default'] OR $value === '')
        {
            $class = 'config_value_required';
        }
    }

    echo '<div>';
    echo '<div class="config_key">'.$key.'</div>';
    echo '<div class="config_textfield '.$class.'">'.CHtml::textfield($key, $value).'</div>';    
    echo '<div class="config_default">'.Yii::t('app', 'Default value').': \''.$item['default'].'\''.'</div>';
    if($notice !== '')
        echo '<div class="config_notice">'.$notice.'</div>';
    echo '<div class="config_description">'.$item['description'].'</div>';
    echo '</div>';

    echo '<hr/>';
}

echo CHtml::endForm();

?>
