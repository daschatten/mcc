<div class="programRow">
    <div class="programRowChannel">
        <?php 
            if(isset($channelprogram->ProgramGuide->Channels[0])){
                echo $channelprogram->ProgramGuide->Channels[0]->ChannelName; 
            }        
        ?>
    </div>
<?php
    
    if(isset($channelprogram->ProgramGuide->Channels[0])){
        usort($channelprogram->ProgramGuide->Channels[0]->Programs, "psort");

        foreach($channelprogram->ProgramGuide->Channels[0]->Programs as $program)
        {
            $this->renderPartial('_programRowItem', array('program' => $program, 'chanid' => $channelprogram->ProgramGuide->Channels[0]->ChanId));
        }
    }
?>
</div>
