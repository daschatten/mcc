<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
        'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
        'languages'=>array('de_de'),
        'fileTypes'=>array('php'),
        'overwrite'=>true,
        'exclude'=>array(
                '.svn',
                '.gitignore',
                'yiilite.php',
                'yiit.php',
                '/i18n/data',
                '/messages',
                '/vendors',
                '/web/js',
                '/models/mythtv/_base',
                '/extensions',
        ),
        'sort' => true,
);