<?php

$daylist = array();

foreach($programlist as $p)
{
    $start = "$p->StartTime";
    $end = "$p->EndTime";

//    $day = strtotime(Yii::app()->dateFormatter->formatDatetime(strtotime($start), 'short', null));
    $startday = strtotime(date("Y-m-d", strtotime($start)));
    $endday = strtotime(date("Y-m-d", strtotime($end)));
   
    // Check wether $p starts before or end after our display period.
    // In this case it is moved to next or previous day. This only happens
    // if a program starts before $periodstart and ends on our first day or
    // if a program ends after $periodend but starts on our last day

    if($startday < $periodstart)
    {
        $daylist[$periodstart][] = $p;
    }elseif($startday == $periodend){
        $daylist[$startday-24*3600][] = $p;
    }else{
        $daylist[$startday][] = $p;

        // check if program ends on next day
        // and then put it there, too
        if($endday > $startday AND $endday < $periodend)
        {
            $daylist[$startday+24*3600][] = $p;
        }
    }
}

ksort($daylist);

foreach($daylist as $key => $value)
{
    echo '<div class="day">';
    $this->renderPartial('weeksingleview2/_daycol', array(
        'programlist' => $value,
        'day' => $key,
        'periodstart' => $periodstart, 
        'periodend' => $periodend,
        'timestart' => $timestart,
        'timeend' => $timeend,
        'channel' => $channel,
    ));
    echo '</div>';
}
?>
