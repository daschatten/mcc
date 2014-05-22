<?php

// function to compare program webservice objects
function cmp($a, $b)
{
    if (strtotime("$a->StartTime") == strtotime("$b->StartTime")) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}


$listdata = CHtml::listData(Channel::getVisibleChannelList(), 'channum', 'numname');
$guideurl = Yii::app()->createUrl('guide/weeksingleview3');

// create search field
$this->widget('ext.ESelect2.ESelect2',array(
    'model' => $data['searchModel'],
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

$partrow = array();

for($i=0;$i<$data['partcount'];$i++)
{
    $partrow[$i] = array();
}

// sort elements for display by time parts
foreach($data['programlist'] as $partlist)
{
    for($i=0;$i<$data['partcount'];$i++)
    {
        $p =array();
        $p['day'] = $partlist['day'];
        $p['data'] = $partlist['data'][$i]['data']->ProgramGuide->Channels[0]->Programs;

        $partrow[$i][] = $p;
    }
}

$content = array();
$tabs = array();

for($i=0;$i<$data['partcount'];$i++)
{
    $content[$i] = '<div class="week">'.$this->renderPartial('weeksingleview3/_weekrow', array('plist' => $partrow[$i], 'channel' => $data['channel'], 'timestart' => $i * $data['partlength'], 'timeend' => $i * $data['partlength'] + $data['partlength'], 'data' => $data), true).'</div>';
    $start = $i * $data['partlength'] / 3600;
    $end = ($i * $data['partlength'] + $data['partlength']) / 3600;
    $tabs[] = array('label' => "$start - $end", 'content' => $content[$i]);
}

// set last tab active
if(Yii::app()->user->hasState('guide.tab.selected'))
{
    $tabid = Yii::app()->user->getState('guide.tab.selected');
    $tabnr = substr($tabid, -1);
    $tabs[$tabnr - 1]['active'] = true;
}else{
    $tabs[sizeof($tabs)-1]['active'] = true;
}

var_dump(Yii::app()->user->getState('guide.tab.selected'));

echo '<div class="weeksingleview2">';

$this->widget('bootstrap.widgets.TbTabs', array(
    'placement' => 'left',
    'tabs' => $tabs,
    'onShown' => 'function(event){ 
        console.log(event.target);
        var tabid = undefined

        if($(event.target).is("a"))
        {
            tabid = $(event.target).attr("href").replace("#", "");    
        }

        $.ajax({
            "url": "'.Yii::app()->createAbsoluteUrl("guide/activetab").'",
            "data": "tabid=" +  tabid
        }); 
    }',
    ));

echo '</div>';
?>
