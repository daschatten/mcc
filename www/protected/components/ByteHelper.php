<?php

class ByteHelper
{
    public static function getString($bytes = 0, $unit = null)
    {
        if($bytes == null)
        {
            return "0 B";
        }

        $units = array(
            'B' => 1,
            'KB' => 1024,
            'MB' => pow(1024, 2),
            'GB' => pow(1024, 3),
            'TB' => pow(1024, 4),
            'PB' => pow(1024, 5),
            'EB' => pow(1024, 6),
            'ZB' => pow(1024, 7),
            'YB' => pow(1024, 8),
        );

        if($unit != null)
        {
            if(isset($units[$unit]))
            {
                $size = round($bytes / $units[$unit], 2);
                return $size." $unit";
            }

            return "ERROR";
        }
        
        $oldval = $bytes." B";

        foreach($units as $key => $val)
        {
            if($bytes / $val < 1)
            {
                return $oldval;
            }

            $oldval = round($bytes / $val, 2)." $key";
        }

    }
}

?>
