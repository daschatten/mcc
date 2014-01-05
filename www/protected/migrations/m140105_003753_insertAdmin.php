<?php

class m140105_003753_insertAdmin extends CDbMigration
{
	public function up()
	{
        $this->insert('mcc_user', array(
            'id' => '1', 
            'username' => 'admin', 
            'pin' => '0000',
            'description' => 'Default admin account'
            )
        );

	}

	public function down()
	{
        $this->delete('mcc_user', 'id=1');
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
