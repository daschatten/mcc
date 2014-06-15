<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$files = array('/etc/mcc/db.php', '/etc/mcc/params.php', '/etc/mcc/record.php');

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

if(isset($recordItems) AND is_array($recordItems))
{
    $params['recordItems'] = $recordItems;
}

$config = array(
	'basePath' =>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MCC - MythTV Control Center',

	// preloading 'log' component
	'preload'=>array('log'),

    // path aliases
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // yiistrap alias
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.mythtv.*',
		'application.components.*',
		'application.controllers.*',
        'ext.giix-components.*', // giix components
        'bootstrap.helpers.TbHtml', // yiistrap components
        'application.modules.auth.*',
        'application.modules.auth.components.*',
		'application.components.mythservices.*',
        'application.modules.dsconfig.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'put a password here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths' => array(
                        'ext.giix-core', // giix generators
                        'bootstrap.gii', // yiistrap generators
            ),
		),*/
        'auth' => array(
            'strictMode' => true, // when enabled authorization items cannot be assigned children of the same type.
            'userClass' => 'User', // the name of the user model class.
            'userIdColumn' => 'id', // the name of the user id column.
            'userNameColumn' => 'username', // the name of the user name column.
            'defaultLayout' => 'application.views.layouts.main', // the layout used by the module.
            'viewDir' => null, // the path to view files to use with this module. 
        ),
        'dsconfig' => array(
            'useYiiAuth' => true,
            'yiiAuthItem' => 'o_manage_settings',
            'paramsFile' => '/etc/mcc/params.php',
            'dbFile' => '/etc/mcc/db.php',
            'dbLockFile' => '/etc/mcc/dblock',
        ),
	),

	// application components
	'components'=>array(
        'authManager' => array(
            'class' => 'auth.components.CachedDbAuthManager',
            'assignmentTable' => 'mcc_authassignment',
            'itemTable' => 'mcc_authitem',
            'itemChildTable' => 'mcc_authitemchild',
            'behaviors' => array(
                'auth' => array(
                    'class' => 'auth.components.AuthBehavior',
                ),
            ),
        ),
		'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
            'class' => 'auth.components.AuthWebUser',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db' => $db,		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'class' => 'DsErrorHandler',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',   
        ),
        'messages' => array(
            'class' => 'CPhpMessageSource',
            'language' => 'en_en',
        ),
	),
    
    'behaviors'=>array(
        'onbeginRequest'=>array('class'=>'application.components.StartupBehavior'),
    ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => $params,
);

// include custom settings from /etc/mcc/custom.php

if(file_exists('/etc/mcc/custom.php'))
{
    include '/etc/mcc/custom.php';
}


return $config;
