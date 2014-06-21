<?php
$imghtml=CHtml::image('/images/arrow-left.png', Yii::t('app', 'Back to program guide')).Yii::t('app', 'Back to program guide');
echo CHtml::link($imghtml, array('guide/view'));
?>

<h4><?= $data['title'] ?></h4>
<div id="programDetailContent">
    <i><span id="programSubtitle"><?= $data['subtitle'] ?></span></i>
    <div id="programTime"><?= $data['starttimeloc'] ?> - <?= $data['endtimeloc'] ?></div>
    <div id="programChannel"><?= $data['channel'] ?></div>
    <div id="programRecStatus">
    <?php
        echo Yii::t('app', 'Record status').': '.((empty($data['recstatus'])) ? Yii::t('app', 'Not planned') : $data['recstatus']);
    ?>
    </div>

<?php 
    if(Yii::app()->user->checkAccess('o_record_rule_add') or Yii::app()->user->checkAccess('o_record_rule_del'))
    {
        echo '<div id="programRecOptions">';
        echo '<p>';
        echo '<strong>'.Yii::t('app', 'Recording options').'</strong>';
        echo '</p>';
        echo '<p>';
        echo '<i>';
    
        echo Yii::t('app', '{Refresh} recording options after changing them. MythTV takes a while to refresh recording rules.', 
            array(
                '{Refresh}' => CHtml::link(
                    Yii::t('app', 'Refresh'),
                    Yii::app()->createUrl('guide/detail', array('chanid' => $data['chanid'], 'starttime' => $data['starttime']))
                )
            )
        );

        echo '</i>';
        
        echo '</p>';
        echo '<p>';

        if($data['recstatusraw'] == MythTVEnum::rsUnknown)
        {
            if(Yii::app()->user->checkAccess('o_record_rule_add'))
            {
                if(sizeof($templates) == 0)
                {
                    echo Yii::t('app', 'No record templates defined!');
                }else{
                    foreach($templates as $t)
                    {
                        echo '<span class="programRecButton">';
                        echo TbHtml::tooltip( 
                            CHtml::ajaxButton(
                            $t->name, 
                            Yii::app()->createUrl('guide/record', array('template' => $t->record_id, 'type' => $t->type)),
                            array('success' => 'setTimeout(function() {location.reload(); }, '.DsConfig::get('guide_refresh_sleeptime').')')
                        ), '#', $t->description);
                        echo '</span>';
                    }
                }
            }
        }else{
            if(Yii::app()->user->checkAccess('o_record_rule_del'))
            {
                echo '<span class="programRecButton">';
                echo TbHtml::tooltip( 
                    CHtml::ajaxButton(
                        Yii::t('app', 'Delete recording rule'), 
                        Yii::app()->createUrl('guide/delrecord', array('ruleid' => $data['recruleid'])),
                        array('success' => 'setTimeout(function() {location.reload(); }, '.DsConfig::get('guide_refresh_sleeptime').')')
                    ), '#', Yii::t('app', 'Delete recording rule')
                );
                echo '</span>';
            }
        }
    
        echo '</p>';
        echo '</div>';
    }
?>        
    <div id="programDescription"><?= $data['description'] ?></div>
</div>
