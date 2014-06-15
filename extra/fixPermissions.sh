#!/bin/sh

mkdir /var/www/mcc/www/assets
mkdir /var/www/mcc/www/protected/runtime
chown www-data:www-data /var/www/mcc/www/assets
chown www-data:www-data /var/www/mcc/www/protected/runtime

touch /var/www/mcc/www/protected/config/params.php
chown www-data:www-data /var/www/mcc/www/protected/config/params.php

touch /var/www/mcc/www/protected/config/db.php
chown www-data:www-data /var/www/mcc/www/protected/config/db.php

mkdir /etc/mcc
touch /etc/mcc/db.php
touch /etc/mcc/params.php
touch /etc/mcc/custom.php
touch /etc/mcc/record.php

chown -R www-data:www-data /etc/mcc/
