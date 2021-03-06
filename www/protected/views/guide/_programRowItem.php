<?php 

$start = strtotime($program->StartTime);
$end = strtotime($program->EndTime);

$daystart = strtotime(date('Y-m-d'));
$dayend = $daystart + 24*3600;

//
// check wether program starts before today
// and then calculate length from start of day
//
// if program is lasts longer then end of day then calculate length until end of day
//
if($start < $daystart)
{
    $length = $end - $daystart;
}elseif($end >= $dayend){
    $length = $dayend - $start;
}else{
    $length = $end - $start;
}

// calculate real length in minutes for display purposes
$minutes = round(($end - $start) / 60);

// get a factor for second to pixel conversion
// 10 min = 60px;
$factor = 0.1;

$height = $length * $factor;

// set a spacer if program duration is lesser then 10 minutes
// because there is not enough space to display it
if($length < 600)
{
    echo "<div class='programRowItemSpacer' style='height: ".$height."px'>&nbsp;</div>";
    return;
}

// substract border 1px and padding 5px (see css)
$height = $height - 6;
?>

<div class="programRowItem <?php echo MythtvEnum::getRecStatusClass($program->Recording->Status) ?>" style="height: <?php echo $height ?>px" onclick="showProgramModal('<?php echo Yii::app()->createUrl("guide/detail", array('chanid' => $chanid, 'starttime' => $program->StartTime)); ?>')">
    <div class="programRowItemStarttime">
    <?php
        echo Yii::app()->dateFormatter->formatDateTime("$program->StartTime",'short', 'short')." :: ".$minutes." ".Yii::t('app', 'Min.')
    ?>
    </div>
    <div class="programRowItemTitle"><?php echo $program->Title ?></div>
    <div class="programRowItemSubtitle"><?php echo $program->SubTitle ?></div>
    <div class="programRowItemDescription"><?php echo $program->Description ?></div>
</div>    
