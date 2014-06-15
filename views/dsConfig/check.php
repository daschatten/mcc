<?php

echo '<p>';
echo Yii::t('dsconfigModule.app', 'The config items below show you if your application is set up properly:');

echo '<div class="legend-color config_value_set">&nbsp;</div>';
echo '<div>'.Yii::t('dsconfigModule.app', 'Green means that you have set this config item.').'</div>';
echo '<div class="clear"></div>';

echo '<div class="legend-color config_value_notset">&nbsp;</div>';
echo '<div>'.Yii::t('dsconfigModule.app', 'Yellow means that you have not set this config item and the default value is used.').'</div>';
echo '<div class="clear"></div>';

echo '<div class="legend-color config_value_required">&nbsp;</div>';
echo '<div>'.Yii::t('dsconfigModule.app', 'Red means that you have not set this config item, but the item is required for the application to work properly.').'</div>';
echo '<div class="clear"></div>';

echo '</p>';

echo '<hr/>';

echo CHtml::beginForm();

foreach($items as $key => $item)
{
    if($key == "recordItems")
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
        $notice = Yii::t('dsconfigModule.app', 'This config item must be set to a custom value!').' ';

        if($value === $item['default'] OR $value === '')
        {
            $class = 'config_value_required';
        }
    }

    echo '<div>';
    echo '<div class="config_key">'.$key.'</div>';
    echo '<div class="config_textfield '.$class.'">'.CHtml::textfield($key, $value).'</div>';    
    echo '<div class="config_default">'.Yii::t('dsconfigModule.app', 'Default value').': \''.$item['default'].'\''.'</div>';
    if($notice !== '')
        echo '<div class="config_notice image_note">'.$notice.'</div>';

    if(array_key_exists($key, $testresult))
    {
        $result = $testresult[$key];

        if($result === null)
        {
            echo '<div class="config_check_unknown image_note">'.Yii::t('dsconfigModule.app', 'No test defined.').'</div>';
        }elseif($result === true){
            echo '<div class="config_check_success image_ok">'.Yii::t('dsconfigModule.app', 'Test passed.').'</div>';
        }else{
            echo '<div class="config_check_fail image_error">'.Yii::t('dsconfigModule.app', 'Test failed:').' '.$testresult[$key]["message"].'</div>';
        }
    }
    
    echo '<div class="config_description">'.$item['description'].'</div>';
    echo '</div>';

    echo '<hr/>';
}

echo TbHtml::submitButton(Yii::t('dsconfigModule.app', 'Save'), array('color' => TbHtml::BUTTON_COLOR_DANGER));

echo CHtml::endForm();

?>
