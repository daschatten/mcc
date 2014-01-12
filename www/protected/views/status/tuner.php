<?php

$this->renderPartial('_tunerstatus', array('encoderlist' => $encoderlist));
$this->renderPartial('_capturecard', array('capturecardlist' => $capturecardlist));
$this->renderPartial('_cardinput', array('cardinputlist' => $cardinputlist));
$this->renderPartial('_videosource', array('videosourcelist' => $videosourcelist));

?>
