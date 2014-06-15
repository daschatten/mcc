<?php

class DsDbConfig extends DsBaseConfig
{
    public static function getFilename()
    {
        return 'dsdb.php';
    }

    public static function getVarName()
    {
        return 'dsdb';
    }

    public static function test()
    {
        return self::testItems(self::getItems(self::getFilename(), DsDbConfig::getVarName()));
    }
}
?>
