<?php

class DsConfig extends DsBaseConfig
{
    public static function getFilename()
    {
        return 'dsparams.php';
    }

    public static function getVarName()
    {
        return 'dsparams';
    }

    public static function get($name)
    {
        if(in_array($name, Yii::app()->params->keys))
        {
            return Yii::app()->params[$name];
        }else{
            return DsConfig::getItem($name);
        }
    }

    private static function getItem($name)
    {
        $items = DsConfig::getItems(self::getFilename(), DsConfig::getVarName());

        if(array_key_exists($name, $items))
        {
            if($items[$name]['required'])
            {
                throw new DsConfigException("Config item '$name' is required but not set!");
            }else{
                return $items[$name]['default'];
            }
        }else
        {
            throw new DsConfigException("Missing config item '$name'!");
        }
    }

    public static function test()
    {
        return self::testItems(self::getItems(self::getFilename(), DsConfig::getVarName()));
    }
}
?>
