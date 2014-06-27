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
 *  This is en example file for 'protected/config/dsdb.php'
 */

$dsdb = array(
            'connectionString' => array(
                'default' => 'mysql:host=db.example.local;dbname=mydb',
                'required' => true,
                'description' => Yii::t('app', 'Connection string for myapp database.'),
            ),

            'emulatePrepare' => array(
                'default' => '1',
                'required' => false,
                'description' => Yii::t('app', 'See {url} for details.', array('{url}' => '<a href = "http://www.yiiframework.com/doc/api/1.1/CDbConnection#emulatePrepare-detail">http://www.yiiframework.com/doc/api/1.1/CDbConnection#emulatePrepare-detail</a>')),
            ),
       
            'username' => array(
                'default' => 'username', 
                'required' => false,
                'description' => Yii::t('app', 'Username for database login.'),
            ),
        
            'password' => array(
                'default' => 'password', 
                'required' => false,
                'description' => Yii::t('app', 'Password for database login.'),
            ),

            'charset' => array(
                'default' => 'utf8', 
                'required' => false,
                'description' => Yii::t('app', 'Database charset.'),
            ),
        );
