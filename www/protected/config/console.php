<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

$files = array('/etc/mcc/db.php');

foreach($files as $file)
{
    if(file_exists($file))
    {
        include($file);
    }
}

// Check if arrays $db and $params exist. If not create empty ones.

if(!isset($db) OR !is_array($db))
{
    $db = array();
}

if(!isset($params) OR !is_array($params))
{
    $params = array();
}

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MCC - MythTV Control Center',

	// preloading 'log' component
	'preload'=>array('log'),

    // autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.mythtv.*',
		'application.components.*',
		'application.components.mythservices.*',
        'ext.giix-components.*', // giix components
	),


	// application components
	'components'=>array(
		'db'=> $db,
        'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace',
				),
			),
		),
	),
);
