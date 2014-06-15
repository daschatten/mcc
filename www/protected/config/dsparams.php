<?php

$dsparams = array(
            'adminEmail' => array(
                'default' => 'webmaster@example.local', 
                'required' => false,
                'description' => Yii::t('app', 'Enter a valid e-mail adress to receive notifications (not yet implemented).'),
            ),

            'defaultPageSize' => array(
                'default' => '10',
                'required' => false,
                'description' => Yii::t('app', 'Default page size for grid views.'),
            ),

            'mediaUrl' => array(
                'default' => 'http://mcc.example.local/media/', 
                'required' => true,
                'description' => Yii::t('app', 'This url is used to display recordings images.'),
            ),

            'mythbackendUri' => array(
                'default' => 'http://mythtv.example.local:6544', 
                'required' => true,
                'description' => Yii::t('app', 'Uri to mythbackend webservice.'),
                'test' => array(
                    'controller' => 'MythService',
                    'method' => 'test',
                ),
            ),

            'timezone' => array(
                'default' => 'Europe/Berlin', 
                'required' => false,
                'description' => Yii::t('app', 'Timezone for displaying date and time information. See {url} for valid values.', array('{url}' => '<a href="https://php.net/manual/de/timezones.php" target="_blank">https://php.net/manual/de/timezones.php</a>')),
            ),

            'archive_method' => array(
                'default' => 'rsync -avz --progress', 
                'required' => false,
                'description' => Yii::t('app', 'Method used for archiving marked recordings to another storage.'),
            ),

            'archive_source_path' => array(
                'default' => '/mnt/src/', 
                'required' => false,
                'description' => Yii::t('app', 'Source path to archive marked recordings from.'),
            ),

            'archive_dest_path' => array(
                'default' => '/mnt/dest/', 
                'required' => false,
                'description' => Yii::t('app', 'Destination path to archive marked recordings to.'),
            ),

            'home_public' => array(
                'default' => '1', 
                'required' => false,
                'description' => Yii::t('app', 'Wether start page should be visible without login. 1=yes 0=no'),
            ),

            'guide_refresh_sleeptime' =>array(
                'default' =>  '2000', 
                'required' => false,
                'description' => Yii::t('app', 'After changing recording rules the application waits this amount of milliseconds before refreshing the page. This is required because mythtv takes it\'s time to schedule recordings.'),
            ),

            'recordItems' => array(
                'default' => array(
                    array(  'name' => 'Default',
                            'rulename' => 'Default (Template)',
                            'ruletype' => '1',
                            'description' => 'Put description here',
                    ),
                ), 'required' => false,
                'description' => Yii::t('app', 'Configure one click recording buttons (should be moved to database soon).'),
            ),
        );

