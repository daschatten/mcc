<?php
/* @var $this RecordingsController */

$this->breadcrumbs=array(
	'Recordings',
);

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
        ),
        array(
            'name' => 'recgroup',
            'filter' => Recorded::getRecgroups(),
        ),
        array(
            'name' => 'FilesizeGb',
            'filter' => false,
        ),
        array(
            'name' => 'length',
            'filter' => false,
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{download}',
            'buttons' => array(
                'download' => array(
                    'label' => 'DL',
                    'url' => 'Yii::app()->createUrl("Recordings/addDownload", array("pk"=>$data->chanid.",".$data->starttime))',
                    'click' => 'js:function(){
                            $.ajax({
                                url:$(this).attr("href"),
                                }).complete(function() {
                                });
                            $(this).hide();
                            return false;
                        }',
                    'visible' => '(Yii::app()->user->hasState("recordings.archive")) ? !in_array($data->chanid.",".$data->starttime,Yii::app()->user->getState("recordings.archive")) : true',
                ),
            ),
        ),
    ),
));
