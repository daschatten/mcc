<div id="programDetailContent">
    <i><span id="programSubtitle"></span></i>
    <div id="programTime"></div>
    <div id="programChannel"></div>
    <div id="programRecStatus"></div>
    <div id="programRecOptions">
    <?php
        foreach(Config::get('recordItems') as $b)
        {
            echo CHtml::ajaxButton(
                $b['name'], 
                Yii::app()->createUrl('guide/record', array('template' => $b['rulename'], 'type' => $b['ruletype']))
            );
        }
    ?>
    </div>
    <div id="programDescription"></div>
</div>
