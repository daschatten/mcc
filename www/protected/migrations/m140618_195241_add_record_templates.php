<?php

class m140618_195241_add_record_templates extends CDbMigration
{
	public function up()
	{
        $this->createTable('mcc_record_templates', array(
            'id' => 'pk',
            'name' => 'string not null',
            'record_id' => 'integer not null',
            'type' => 'integer not null',
            'description' => 'string',
        ));
        
        $this->insert('mcc_authitem', array(
            'name' => 'o_manage_recordtemplates',
            'type' => 0,
            'description' => 'Manage record templates.',
        ));

        $this->insert('mcc_authitemchild', array('parent' => 't_admin_all', 'child' => 'o_manage_recordtemplates'));
	}

	public function down()
	{
        $this->dropTable('mcc_record_templates');
	}
}
