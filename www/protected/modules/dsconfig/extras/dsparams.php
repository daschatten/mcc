<?php

/*
 * A parameter is defined as array with following content:
 * 'default': Default value to be used if no custom value is set.
 * 'required': Wether a custom value must be set. If not, an exception is thrown and configuration dialog is shown.
 * 'description': Parameter description.
 * 'test': Array to validate parameter value. It consists of following content:
 *      'controller': Controller which holds method, see below.
 *      'method': Method used to validate parameter value. Return values should be true if everything is ok or a string describing the problem.
 */

/*
 *  This is en example file for 'protected/config/dsparams.php'
 */

$dsparams = array(
            'adminEmail' => array(
                'default' => 'webmaster@example.local',
                'required' => false,
                'description' => Yii::t('app', 'Enter a valid e-mail adress to receive notifications.'),
            ),

            'defaultPageSize' => array(
                'default' => '10',
                'required' => false,
                'description' => Yii::t('app', 'Default page size for grid views.'),
            ),

            'webserviceUri' => array(
                'default' => 'http://webservicehost:port',
                'required' => true,
                'description' => Yii::t('app', 'Uri to webservice.'),
                'test' => array(
                    'controller' => 'MyService',
                    'method' => 'test',
                ),
            ),
        );
