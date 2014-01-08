<?php 

$this->widget('bootstrap.widgets.TbTabs', array(
    'tabs' => array(
        array('label' => Yii::t('app', 'List view'), 'content' => 'List view', 'active' => true),
        array('label' => Yii::t('app', 'Calendar view'), 'content' => 'Calendar view'),
    ),
));
?>
