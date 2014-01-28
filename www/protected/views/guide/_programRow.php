<div class="programRow">
    <div class="programRowChannel">
        <?php echo $channelprogram->ProgramGuide->Channels[0]->ChannelName; ?>
        exit;
    </div>
<?php
    

    usort($channelprogram->ProgramGuide->Channels[0]->Programs, "psort");

    foreach($channelprogram->ProgramGuide->Channels[0]->Programs as $program)
    {
        $this->renderPartial('_programRowItem', array('program' => $program, 'chanid' => $channelprogram->ProgramGuide->Channels[0]->ChanId));
    }
?>
</div>
