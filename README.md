mcc
===

MythTV Control Center - An alternative to the standard mythtv webinterface mythweb.

Notes
-----

This web application is considered 'alpha' at the moment, use it on your own risk. Regularly backup your mythtv database!

Requirements
------------

* Yii http://www.yiiframework.com
  Put framework to '/usr/share/frameworks/yii/'. For Yii 1.1.14 the path should be '/usr/share/frameworks/yii/yii-1.1.14.f0fee9'.
  Or change path to framework in /var/www/mcc/www/index.php
* MythTV http://www.mythtv.org/
* Apache, PHP and MySQL (they should already be installed with mythtv)
* php-curl
* php-cli
* git

Installation
------------

Be root.

Web application:
```
cd /var/www
git clone git@github.com:daschatten/mcc.git

/var/www/mcc/extra/fixPermissions.sh

cd /var/www/mcc
git submodule init
git submodule update

```

Apache config:

```
vim /etc/apache2/sites-available/mcc
```

with content:

```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    Servername  mcc.mydomain.local

    DocumentRoot /var/www/mcc/www

    CustomLog /var/log/apache/mcc-access.log combined
    ErrorLog /var/log/apache/mcc-error.log

    Alias /media path-to-mythtv-recordings-dir

    <Directory "path-to-mythtv-recordings-dir">
        order allow,deny
        allow from all
    </Directory>
</VirtualHost>
```

Replace 'path-to-mythtv-recordings-dir' with your values.

Enable module and reload apache:

```
a2ensite mcc
/etc/init.d/apache2 reload
```

MCC config:

```
cd /var/www/mcc/www/protected/config
cp main.php.example main.php
vim main.php
```

* Search block starting with "'db'=>array(" and configure your mythtv database connection.
* Set application parameter at bottom of config file to your needs (look at comments).

Database modifications:

```
/var/www/mcc/www/protected/yiic migrate
```

First login
-----------

Login as 'Admin' with PIN '0000'
Create users, add roles!

Have fun!

