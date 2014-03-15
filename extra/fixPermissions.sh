#!/bin/sh

mkdir ../www/assets
mkdir ../www/protected/runtime
chown www-data:www-data ../www/assets -R
chown www-data:www-data ../www/protected/runtime -R
