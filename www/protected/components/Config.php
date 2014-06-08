<?php
/**
 * Config acts as a layer between config in config/main.php and the application itself.
 * If a config item is added to the application and config/main.php.example it must be 
 * added here, too. This makes sure that the apllication will never be broken if a config
 * item is not added to config/main.php
 *
 */
class Config
{
    public static function get($name)
    {
        if(in_array($name, Yii::app()->params->keys))
        {
            return Yii::app()->params[$name];
        }else{
            return Config::getItem($name);
        }
    }

    private static function getItem($name)
    {
        $items = Config::getItems();

        if(array_key_exists($name, $items))
        {
            if($items[$name]['required'])
            {
                Yii::app()->controller->redirect(Yii::app()->createUrl("config/check"));
            }else{
                return $items[$name]['default'];
            }
        }else
        {
            Yii::app()->controller->redirect(Yii::app()->createUrl("config/check"));
            // throw new CHttpException(400, Yii::t('app', "The required config item '{name}' could not be found! Please visit {url} for further informations.", array('{name}' => $name, '{url}' => CHtml::link('https://github.com/daschatten/mcc#config-items', 'https://github.com/daschatten/mcc#config-items'))));
        }
    }

    public static function getItems()
    {
        return array(
            'adminEmail' => array(
                'default' => 'webmaster@example.local', 
                'required' => false,
                'description' => Yii::t('app', 'Enter a valid e-mail adress to receive notifications (not yet implemented).'),
            ),

            'defaultPageSize' => array(
                'default' => 10, 
                'required' => false,
                'description' => Yii::t('app', 'Default page size for grid views.'),
            ),

            'mediaUrl' => array(
                'default' => 'http://mcc.example.local/media/', 
                'required' => true,
                'description' => Yii::t('app', 'This url is used to display recordings images.'),
            ),

            'mythbackendUri' => array(
                'default' => 'http://mcc.example.local:6544', 
                'required' => true,
                'description' => Yii::t('app', 'Uri to mythbackend webservice.'),
            ),

            'utcoffset' => array(
                'default' => -3600, 
                'required' => false,
                'description' => Yii::t('app', 'Deprecated'),
            ),

            'timezone' => array(
                'default' => 'Europe/Berlin', 
                'required' => false,
                'description' => Yii::t('app', 'Timezone for displaying date and time information. See {url} for valid values.', array('{url}' => '<a href="https://php.net/manual/de/timezones.php" target="_blank">https://php.net/manual/de/timezones.php</a>')),
            ),

            'archive.method' => array(
                'default' => 'rsync -avz --progress', 
                'required' => false,
                'description' => Yii::t('app', 'Method used for archiving marked recordings to another storage.'),
            ),

            'archive.source.path' => array(
                'default' => '/mnt/src/', 
                'required' => false,
                'description' => Yii::t('app', 'Source path to archive marked recordings from.'),
            ),

            'archive.dest.path' => array(
                'default' => '/mnt/dest/', 
                'required' => false,
                'description' => Yii::t('app', 'Destination path to archive marked recordings to.'),
            ),

            'home.public' => array(
                'default' => true, 
                'required' => false,
                'description' => Yii::t('app', 'Wether start page should be visible without login. 1=yes 0=no'),
            ),

            'guide.refresh.sleeptime' =>array(
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
    }
}
?>
