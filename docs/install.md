# Installation

## Requirements

* MythTV http://www.mythtv.org/
* Apache, PHP and MySQL (they should already be installed with mythtv). Debian packages:
  * apache2
  * libapache2-mod-php5
  * php5
  * php5-mysql
  * php5-curl
  * php5-cli
  * php5-json

## .tar.bz2 packages

* Get package from https://github.com/daschatten/mcc
* Unzip package to '/var/www/'
* Run '/var/www/mcc/extra/install.sh' as root
* Open url 'http://&lt;your systems ip&gt;/mcc'
* Enter database configuration data when prompted
* Enter mythbackend configuration data when prompted

## First login

Login as 'Admin' with PIN '0000'. Create users, assign roles! And change admin PIN! And do not forget to create record templates (admin menu).
