<div class="programRow">
    <div class="programRowChannel">
        <?php echo $channelprogram[0]->channel->name ?>
    </div>
<?php 
    foreach($channelprogram as $program)
    {
        $this->renderPartial('_programRowItem', array('program' => $program));
    }
?>
</div>
