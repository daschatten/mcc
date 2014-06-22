#!/bin/sh

echo ""
echo "Checking for user root..."

if ! [ $(id -u) = 0 ]; then
   echo "You must be root to do this." 1>&2
    echo ""
   exit 100
else
    echo "Ok, we are root."
    echo ""
fi

echo "Setting up directories and permissions"
echo ""

if [ ! -d "/var/www/mcc/www/assets" ]; then
    mkdir /var/www/mcc/www/assets
fi

if [ ! -d "/var/www/mcc/www/protected/runtime" ]; then
    mkdir /var/www/mcc/www/protected/runtime
fi

chown www-data:www-data /var/www/mcc/www/assets
chown www-data:www-data /var/www/mcc/www/protected/runtime

touch /var/www/mcc/www/protected/config/params.php
chown www-data:www-data /var/www/mcc/www/protected/config/params.php

touch /var/www/mcc/www/protected/config/db.php
chown www-data:www-data /var/www/mcc/www/protected/config/db.php

if [ ! -d "/etc/mcc" ]; then
    mkdir /etc/mcc
fi

if [ ! -e "/etc/mcc/db.php" ]; then
    cp /var/www/mcc/extra/db.php.init /etc/mcc/db.php
fi

touch /etc/mcc/db.php
touch /etc/mcc/params.php
touch /etc/mcc/custom.php
touch /etc/mcc/record.php

chown -R www-data:www-data /etc/mcc/

echo "Upgrading database"
echo ""

/var/www/mcc/www/protected/yiic migrate --interactive=0

echo "Configuring webserver"
echo ""

if [ -e "/etc/php5/cli/conf.d/suhosin.ini" ]; then

    RES=`grep 'suhosin.executor.include.whitelist = phar' /etc/php5/cli/conf.d/suhosin.ini | wc -l`

    if [ $RES = 0 ]; then
        echo "Applying suhosin whitelist entry for 'phar'"
        echo "suhosin.executor.include.whitelist = phar" >> /etc/php5/cli/conf.d/suhosin.ini
    fi
fi

cp /var/www/mcc/extra/mcc.conf.apache /etc/apache2/conf.d/
/etc/init.d/apache2 reload


echo "Done!"
echo ""
