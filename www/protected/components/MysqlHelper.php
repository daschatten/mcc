<?php

class MysqlHelper
{
    static public function Timestamp2Mysql($timestamp = 0)
    {
        ($timestamp == 0) ? time() : $timestamp;

        return date("Y-m-d\TH:i:s", $timestamp);
    }

    static public function Mysql2Timestamp($mysqlDatetime)
    {
        # 2013-04-01 11:05:00
        $dt = new DateTime($mysqlDatetime);
        return $dt->getTimestamp();

    }

    static public function FixMysqlTimestamp($ts)
    {
        return str_replace(" ", "T", $ts);
    }
}

?>
