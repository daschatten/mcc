<div id="programGuide">
<?php

    // we need a function to sort the program array (StartTime ASC)
    // to get the proper timeline

    function psort($a, $b)
    {
        if($a->StartTime == $b->StartTime)
        {
            return 0;
        }

        return ($a->StartTime < $b->StartTime) ? -1 : 1;
    }
    foreach($programlist as $channelprogram)
    {
        $this->renderPartial('_programRow', array('channelprogram' => $channelprogram));
    }

?>
</div>


<?php $this->renderPartial('_detailpopup'); ?>
