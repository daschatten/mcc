<?php

$listdata = CHtml::listData(Channel::getVisibleChannelList(), 'channum', 'numname');
$guideurl = Yii::app()->createUrl('guide/weeksingleview2');

$this->widget('ext.ESelect2.ESelect2',array(
    'model' => $searchModel,
    'attribute' => 'channum',
    'data'=>$listdata,
    'htmlOptions' => array(
        'id' => 'chanselect',
        'onChange' => "$(location).attr('href', function(index, attr){
            channum = $('#chanselect option:selected').val();
            return '$guideurl' + '/channum/' + channum;
        })",
        'style' => 'width: 250px;',
    ),
)); 

// function to compare program webservice objects
function cmp($a, $b)
{
    if (strtotime("$a->StartTime") == strtotime("$b->StartTime")) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}


$weeklist1 = array();
$weeklist2 = array();
$weeklist3 = array();

foreach($programlist->ProgramGuide->Channels[0]->Programs as $p)
{
    $start = "$p->StartTime";
    $end = "$p->EndTime";

    $starthour = date("G", strtotime($start));
    $endhour = date("G", strtotime($end));

    // check in which timeslot we have to display $p

    if(($starthour < 8 or $endhour < 8) AND strtotime($end) <= $periodend)
    {
        $weeklist1[] = $p;
    }

    if(($starthour >= 8 and $starthour < 16) or ($endhour >= 8 and $endhour < 16) ){
        $weeklist2[] = $p;
    }

    if(($starthour >= 16 or $endhour > 16) AND strtotime($start) >= $periodstart){
        $weeklist3[] = $p;
    }
}


$week1 = '<div class="week">'.$this->renderPartial('weeksingleview2/_weekrow', array('programlist' => $weeklist1, 'periodstart' => $periodstart, 'periodend' => $periodend, 'channel' => $channel, 'timestart' => 0, 'timeend' => 8), true).'</div>';
$week2 = '<div class="week">'.$this->renderPartial('weeksingleview2/_weekrow', array('programlist' => $weeklist2, 'periodstart' => $periodstart, 'periodend' => $periodend, 'channel' => $channel, 'timestart' => 8, 'timeend' => 16), true).'</div>';
$week3 = '<div class="week">'.$this->renderPartial('weeksingleview2/_weekrow', array('programlist' => $weeklist3, 'periodstart' => $periodstart, 'periodend' => $periodend, 'channel' => $channel,  'timestart' => 16, 'timeend' => 24), true).'</div>';

echo '<div class="weeksingleview2">';

$this->widget('bootstrap.widgets.TbTabs', array(
    'placement' => 'left',
    'tabs' => array(
        array('label' => '00:00 - 08:00', 'content' => $week1),
        array('label' => '08:00 - 16:00', 'content' => $week2),
        array('label' => '16:00 - 24:00', 'content' => $week3, 'active' => true),
        ),
    ));

echo '</div>';

$this->renderPartial('_detailpopup');

?>
