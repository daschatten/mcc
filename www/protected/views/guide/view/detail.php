<?php
$imghtml=CHtml::image('/images/arrow-left.png', Yii::t('app', 'Back to program guide')).Yii::t('app', 'Back to program guide');
echo CHtml::link($imghtml, array('guide/view'));
?>

<h4><?= $data['title'] ?></h4>
<div id="programDetailContent">
    <i><span id="programSubtitle"><?= $data['subtitle'] ?></span></i>
    <div id="programTime"><?= $data['starttimeloc'] ?></div>
    <div id="programChannel"><?= $data['channel'] ?></div>
    <div id="programRecStatus"><?= $data['recstatus'] ?></div>
    <div id="programRecOptions">
        <p>
        <?php 
            echo Yii::t('app', 'Recording options');
            echo '</p>';
            echo '<p>';
            echo '<i>';
            echo CHtml::linkButton(
                    Yii::t('app', 'Refresh recording options'), 
                    array('submit' => Yii::app()->createUrl('guide/detail', array('chanid' => $data['chanid'], 'starttime' => $data['starttime'])))
                );
            echo ' ';
            echo Yii::t('app', 'after changing them. MythTV takes a while to refresh recording rules.');
            echo '</i>';
        ?>
        </p>
        <p>
    <?php
        if($data['recstatusraw'] == MythTVEnum::rsUnknown)
        {
            foreach(Yii::app()->params['recordItems'] as $b)
            {
                echo '<span class="programRecButton">';
                echo TbHtml::tooltip( 
                    CHtml::ajaxButton(
                    $b['name'], 
                    Yii::app()->createUrl('guide/record', array('template' => $b['rulename'], 'type' => $b['ruletype']))
                ), '#', $b['description']);
                echo '</span>';
            }
        }else{
                echo '<span class="programRecButton">';
                echo TbHtml::tooltip( 
                    CHtml::htmlButton(
                        Yii::t('app', 'Delete recording rule'), 
                        array('submit' => Yii::app()->createUrl('guide/delrecord', array('ruleid' => $data['recruleid'])))
                    ), '#', Yii::t('app', 'Delete recording rule')
                );
                echo '</span>';
        }
    ?>
        </p>
    </div>
    <div id="programDescription"><?= $data['description'] ?></div>
</div>
