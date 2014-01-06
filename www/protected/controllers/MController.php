<?php

class MController extends CController
{
    public $breadcrumbs;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

}
