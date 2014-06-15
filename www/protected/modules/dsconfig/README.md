# General information

dsconfig is a yii module which provides web based configuration management for sections 'db' and 'params' from main.php and console.php. It provides an error handler which catches various errors and takes an appropriate action. For database errors (CDbException) a web based database configuration page is displayed, but only if this is desired (file based access lock is set after successful configuration). For config errors (an own method DsConfig::get('name') exists) a configuration page is displayed. This page displays current status, default values, value checks if defined and description for each config item are displayed. For all other errors a generic error page is displayed.

This module comes with following languages:

* english
* german

# Installation

Clone repository to 'protected/modules/'

Add to your 'modules' array in 'main.php':

```php
        'dsconfig' => array(
            'useYiiAuth' => true,
            'yiiAuthItem' => 'o_manage_settings',
            'paramsFile' => '/etc/myapp/params.php',
            'dbFile' => '/etc/myapp/db.php',
            'dbLockFile' => '/etc/myapp/dblock',
        ),
```

Parameter description:

* 'useYiiAuth': wether to use yii-auth for configuration page ('params').
* 'yiiAuthItem': yii auth operation or task or role which is required to display configuration page ('params').
* 'paramsFile': file which holds 'params' array, read and write permission is required.
* 'dbFile': file which holds 'db' array, read and write permission is required.
* 'dbLockFile': file which locks access to database configuration page. Remove this to gain access to database configuration page if locked. Read and write permission is required.

Example main.php:

```php
$files = array('/etc/myapp/db.php', '/etc/myapp/params.php'); 
 
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

...

'db' => $db,

...

'params' => $params,

```
