<?php

class m140209_122405_addYiiAuthTables extends CDbMigration
{
	public function safeUp()
    {
        $this->createTable('mcc_authitem',array(
            'name' => 'varchar(64)',
            'type' => 'int not null',
            'description' => 'text',
            'bizrule' => 'text',
            'data' => 'text',
            'PRIMARY KEY (name)',
        ));

        $this->createTable('mcc_authitemchild', array(
            'parent' => 'varchar(64) not null',
            'child' => 'varchar(64) not null',
            'PRIMARY KEY (parent, child)',
        ));

        $this->createTable('mcc_authassignment', array(
            'itemname' => 'varchar(64) not null',
            'userid' => 'varchar(64) not null',
            'bizrule' => 'text',
            'data' => 'text',
            'PRIMARY KEY (itemname, userid)',
        ));


        $this->addForeignKey('parent_fk', 'mcc_authitemchild', 'parent', 'mcc_authitem', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('child_fk', 'mcc_authitemchild', 'child', 'mcc_authitem', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('itemname_fk', 'mcc_authassignment', 'itemname', 'mcc_authitem', 'name', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
        $this->dropForeignKey('parent_fk', 'mcc_authitemchild');
        $this->dropForeignKey('child_fk', 'mcc_authitemchild');
        $this->dropForeignKey('itemname_fk', 'mcc_authassignment');

        $this->dropTable('mcc_authitem');
        $this->dropTable('mcc_authitemchild');
        $this->dropTable('mcc_authassignment');
	}
}
