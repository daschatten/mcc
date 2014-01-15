<div id="programGuide">
<?php

    foreach($programlist as $channelprogram)
    {
        $this->renderPartial('_programRow', array('channelprogram' => $channelprogram));
    }

?>
</div>
