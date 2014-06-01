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
            return $items[$name];
        }else
        {
            throw new CHttpException(400, Yii::t('app', "The required config item '{name}' could not be found! Please visit {url} for further informations.", array('{name}' => $name, '{url}' => CHtml::link('https://github.com/daschatten/mcc#config-items', 'https://github.com/daschatten/mcc#config-items'))));
        }
    }

    protected static function getItems()
    {
        return array(
            'adminEmail'                => 'webmaster@example.local',
            'defaultPageSize'           => 10,
            'mediaUrl'                  => 'http://mcc.example.local/media/', 
            'mythbackendUri'            => 'http://mcc.example.local:6544',
            'utcoffset'                 => 3600,
            'timezone'                  => 'Europe/Berlin',
            'archive.method'            => 'rsync -avz --progress',
            'archive.source.path'       => '/mnt/src/',
            'archive.dest.path'         => '/mnt/dest/',
            'home.public'               => true,
            'guide.refresh.sleeptime'   => '2000',
            'recordItems' => array(
                array(  'name' => 'Default',
                        'rulename' => 'Default (Template)',
                        'ruletype' => '1',
                        'description' => 'Put description here',
                ),
            ),
        );
    }
}
?>
