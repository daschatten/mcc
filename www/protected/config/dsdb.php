<?php

$dsdb = array(
            'connectionString' => array(
                'default' => 'mysql:host=mythtv.example.local;dbname=mythtv', 
                'required' => true,
                'description' => Yii::t('app', 'Connection string for mythtv database.'),
            ),

            'emulatePrepare' => array(
                'default' => '1',
                'required' => false,
                'description' => Yii::t('app', 'See {url} for details.', array('{url}' => '<a href = "http://www.yiiframework.com/doc/api/1.1/CDbConnection#emulatePrepare-detail">http://www.yiiframework.com/doc/api/1.1/CDbConnection#emulatePrepare-detail</a>')),
            ),

            'username' => array(
                'default' => 'mcc', 
                'required' => false,
                'description' => Yii::t('app', 'Username for database login.'),
            ),

            'password' => array(
                'default' => 'mcc', 
                'required' => false,
                'description' => Yii::t('app', 'Password for database login.'),
            ),

            'charset' => array(
                'default' => 'utf8', 
                'required' => false,
                'description' => Yii::t('app', 'Database charset.'),
            ),
        );

