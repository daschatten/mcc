<?php

$daylist = array();

foreach($plist as $programlist)
{
    echo '<div class="day">';
    $this->renderPartial('weeksingleview3/_daycol', array(
        'data' => array(
            'programlist' => $programlist,
            'day' => $programlist['day'],
            'timestart' => $timestart,
            'timeend' => $timeend,
            'channel' => $channel,
            ),
    ));
    echo '</div>';
}
?>
