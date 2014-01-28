<?php

class GuideSearchModel extends CModel
{
    public $channum;
    public $starttime;

    public function attributeNames()
    {
        return array('channum', 'starttime');
    }
}

?>
