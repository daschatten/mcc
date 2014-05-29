<?php

if(Yii::app()->user->checkAccess("o_archive_use"))
{
    echo '<p>';
    echo Yii::t('app', 'You can add recordings to archive list by clicking on the "archive" button and then go to {Recordings->Archive}.', 
        array(
            '{Recordings->Archive}' => CHtml::link(
                Yii::t('app', 'Recordings')." -> ".Yii::t('app', 'Archive'),
                $this->createUrl('Recordings/archive')
            ),
        )
        );
    echo '</p>';
}


$this->renderPartial('_recordingInfo');

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $recorded->search(),
    'filter' => $recorded,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'selectableRows'=>1,
    'selectionChanged'=>'function(id){ 
                            location.href = "'.$this->createUrl('Recordings/recordingInfo').'/id/"+$.fn.yiiGridView.getSelection(id);
                            return;
                            $("#recordingDetailModal").modal();
                            $.getJSON("'.$this->createUrl('recordingInfo').'", "id="+$.fn.yiiGridView.getSelection(id), function(data){
                                $("#recordingTitle").html(data["title"])
                                $("#recordingSubtitle").html(data["subtitle"])
                                $("#recordingDescription").html(data["description"])
                                $("#recordingImage").attr("src", "'.Yii::app()->params['mediaUrl'].'" + data["basename"] + ".png");
                                $("#recordingDate").html(data["starttime"])
                                $("#recordingLength").html(data["length"])
                                $("#recordingEpisodeString").html(data["episodeString"])
                                $("#recordingRecgroup").html(data["recgroup"])
                                $("#recordingRating").html(data["stars"])
                                $("#recordingFilesize").html(data["filesize"])
                            });
                            
                         }',
    'columns' => array(
        array(
            'name' => 'starttime',
            'header' => Yii::t('app', 'Date'),
            'filter' => false,
            'value' => 'Yii::app()->dateFormatter->formatDateTime($data->starttime, "short", "short")',
        ),
        array(
            'name' => 'channel.name',
        ),
        array(
            'name' => 'title',
        ),
        array(
            'name' => 'subtitle',
        ),
        array(
            'name' => 'episodeString',
            'filter' => false,
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'recgroup',
            'filter' => Recorded::getRecgroups(),
        ),
        array(
            'name' => 'FilesizeGb',
            'filter' => false,
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'name' => 'length',
            'filter' => false,
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
        array(
            'header' => Yii::t('app', 'Archive'),
            'class' => 'CButtonColumn',
            'template' => '{download}',
            'buttons' => array(
                'download' => array(
                    'label' => Yii::t('app', 'Archive'),
                    'imageUrl' => '/images/server-database.png',
                    'url' => 'Yii::app()->createUrl("Recordings/addToArchive", array("pk"=>$data->chanid.",".$data->starttime))',
                    'click' => 'js:function(){
                            $.ajax({
                                url:$(this).attr("href"),
                                context: $(this),
                                }).success(function() {
                                    $(this).hide();
                                });
                            return false;
                        }',
                    'visible' => '(Yii::app()->user->hasState("recordings.archive")) ? !in_array($data->chanid.",".$data->starttime,Yii::app()->user->getState("recordings.archive")) : true',
                ),
            ),
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
            'visible' => Yii::app()->user->checkAccess("o_archive_use"),
        ),
        array(
            'header' => Yii::t('app', 'Watched'),
            'class' => 'CCheckBoxColumn',
            'checked' => '$data->watched',
            'selectableRows' => false,
            'htmlOptions' => array('class' => 'tdcenter'),
            'headerHtmlOptions' => array('class' => 'tdcenter'),
        ),
    ),
));
