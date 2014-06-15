<?php

abstract class DsBaseConfig
{

    public static function getItems($filename, $varname)
    {
        $filename = Yii::app()->basePath.'/config/'.$filename;

        if(file_exists($filename))
        {
            include $filename;
        }

        if(isset($$varname))
        {
            return $$varname;
        }

        return array();
    }

    public static function testItems($items)
    {
        $testresult = array();

        foreach($items as $key => $value)
        {
            if(isset($value['test']) AND is_array($value['test']) AND isset($value['test']['controller']) AND isset($value['test']['method']))
            {
                $result = $value['test']['controller']::$value['test']['method']();

                if($result !== true)
                {
                    $testresult[$key] = array('message' => $result);
                }else{
                    $testresult[$key] = true;
                }
            }else{
                $testresult[$key] = null;
            }
        }

        return $testresult;    
    }
}
?>
