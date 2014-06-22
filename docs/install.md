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
* Unpack package to '/var/www/':
```bash
cd /var/www
tar -xjf mcc.tar.bz2
```
* Run installation as root:
```bash
/var/www/mcc/extra/install.sh
```
* Open url 'http://&lt;your systems ip&gt;/mcc'
* Enter database configuration data when prompted
* Run installation as root second time:
```bash
/var/www/mcc/extra/install.sh
```
* Enter mythbackend configuration data when prompted

## First login

Login as 'Admin' with PIN '0000'. Create users, assign roles! And change admin PIN! And do not forget to create record templates (admin menu).
