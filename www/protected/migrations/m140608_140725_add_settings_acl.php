<?php

class m140608_140725_add_settings_acl extends CDbMigration
{
	public function up()
	{
        $this->insert('mcc_authitem', array(
            'name' => 'o_manage_settings',
            'type' => 0,
            'description' => 'Manage settings.',
        ));

        $this->insert('mcc_authitemchild', array('parent' => 't_admin_all', 'child' => 'o_manage_settings'));
	}

	public function down()
	{
        $this->delete('mcc_authitemchild', 'parent like "t_admin_all" AND child like "o_manage_settings"');
        $this->delete('mcc_authitem', 'name like "o_manage_settings"');
    }
	

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
