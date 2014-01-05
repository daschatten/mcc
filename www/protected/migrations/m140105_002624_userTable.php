<?php

class m140105_002624_userTable extends CDbMigration
{
	public function up()
	{
        $this->createTable('mcc_user',array(
            'id' => 'pk',
            'username' => 'string not null',
            'pin' => 'string not null',
            'description' => 'string',
        ));

	}

	public function down()
	{
        $this->dropTable('mcc_user');
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
