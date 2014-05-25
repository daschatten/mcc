<?php

$day = $data['day'];
$programlist = $data['programlist']['data'];
$timestart = $data['timestart'];
$timeend = $data['timeend'];
$channel = $data['channel'];

//var_dump($programlist); exit;

echo '<div>'.Yii::app()->dateFormatter->formatDatetime($day, 'short', null).'</div>';

usort($programlist, 'cmp');

//print_r($programlist); exit;

$list = array();
$total_length = 0;
$total_px = 600;
$min_px = 15;

$timestart_ts = $day + $timestart * 3600;
$timeend_ts = $day + $timeend * 3600;

foreach($programlist as $p)
{   
    $start = strtotime("$p->StartTime");
    $end = strtotime("$p->EndTime");

    if($start < $timestart_ts)
    {
        $start = $timestart_ts;
    }

    if($end > $timeend_ts)
    {
        $end = $timeend_ts;
    }

    $length = $end - $start;

    $total_length = $total_length + $length;

    $list[] = array(
        'length' => $length,
        'p' => $p,
    );
}

// we need a minimum of 10px per element
// the remaining space is available for 
// additional element content according to 
// their length
$avail_px = 600 - (count($list) * $min_px) - count($list);

$i = 1;
foreach($list as $elem)
{
    $p = $elem['p']; 
    $my_percent = round($elem['length'] * 100 / $total_length, 2);
    $mypx = round($min_px + ($avail_px / 100 * $my_percent), 2);

    if($i == count($list))
    {
        $class = "lastentry";
    }else{
        $class = "entry";
    }

    echo '<div 
            class="'.$class.'" 
            style="height: '.$mypx.'px"
            onclick=\'location.href = "'.$this->createUrl('guide/detail', array('chanid' => $channel->chanid, 'starttime' => "$p->StartTime")).'"\'
            >';
    echo "<p>$p->Title</p>";
    // echo date("G", strtotime("$p->StartTime")).":".date("G", strtotime("$p->EndTime"));
    echo '</div>';
    $i++;
}
?>
