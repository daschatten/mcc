<?php

class MccCommand extends CConsoleCommand
{
    public function actionDebugShowing($title)
    {
        echo "\n";
        echo "### Searching for title '$title'...\n";

        echo "\n";

        // find recording rules
        echo '# Recording rules:'."\n";

        $criteria = new CDbCriteria();
        $criteria->condition = 'title like :title';
        $criteria->params = array(':title' => $title);

        $list = Record::model()->findAll($criteria);

        if(sizeof($list) == 0)
        {
            echo 'No recording rules found'."\n";
        }else{
            echo sizeof($list).' recordings found:'."\n";

            foreach($list as $item)
            {
                echo $item->typeName($item->type)."\n";
            }
        }

        echo "\n";

        // find recordings
        echo '# Recordings:'."\n";

        $criteria = new CDbCriteria();
        $criteria->condition = 'title like :title';
        $criteria->params = array(':title' => $title);
        $criteria->order = "starttime ASC";

        $list = Recorded::model()->findAll($criteria);

        if(sizeof($list) == 0)
        {
            echo 'No recording rules found'."\n";
        }else{
            echo sizeof($list).' recordings found:'."\n";

            foreach($list as $item)
            {
                echo $item->starttime."\t".$item->recgroup."\t".$item->channel->name."\n";
            }
        }

        echo "\n";

        // find program
        echo '# Program:'."\n";

        $criteria = new CDbCriteria();
        $criteria->condition = 'title like :title';
        $criteria->params = array(':title' => $title);
        $criteria->order = "starttime ASC";

        $list = Program::model()->findAll($criteria);

        if(sizeof($list) == 0)
        {
            echo 'No program items found'."\n";
        }else{
            echo sizeof($list).' program items found:'."\n";

            foreach($list as $item)
            {
                echo $item->starttime."\t".$item->channel->name."\n";
            }
        }

        echo "\n";

        // find oldrecorded
        echo '# Oldrecord:'."\n";

        $criteria = new CDbCriteria();
        $criteria->condition = 'title like :title';
        $criteria->params = array(':title' => $title);
        $criteria->order = "starttime ASC";

        $list = Oldrecorded::model()->findAll($criteria);

        if(sizeof($list) == 0)
        {
            echo 'No oldrecorded items found'."\n";
        }else{
            echo sizeof($list).' oldrecorded items found:'."\n";

            foreach($list as $item)
            {
                echo $item->starttime."\t".$item->channel->name."\n";
            }
        }


        echo "\n";

    }
}

?>
