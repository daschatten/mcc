<div id="programDetailContent">
    <i><span id="programSubtitle"></span></i>
    <div id="programTime"></div>
    <div id="programChannel"></div>
    <div id="programRecStatus"></div>
    <div id="programRecOptions">
    <?php
        foreach(Yii::app()->params['recordItems'] as $name => $templatename)
        {
            echo CHtml::ajaxButton(
                $name, 
                Yii::app()->createUrl('guide/record', array('template' => $templatename))
            );
        }
    ?>
    </div>
    <div id="programDescription"></div>
</div>
