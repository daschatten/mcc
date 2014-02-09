<?php

class m140209_125747_fillAuthTables extends CDbMigration
{
    // column type: Role=2, Task=1, Operation=0
	public function safeUp()
	{
        // operations
        $this->insert('mcc_authitem', array(
            'name' => 'recording_add',
            'type' => 0,
            'description' => 'Add recording rules',
        ));
        
        $this->insert('mcc_authitem', array(
            'name' => 'recording_delete',
            'type' => 0,
            'description' => 'Delete recording rules',
        ));
        
        $this->insert('mcc_authitem', array(
            'name' => 'recording_modify',
            'type' => 0,
            'description' => 'Modify recording rules',
        ));

        // tasks
        $this->insert('mcc_authitem', array(
            'name' => 'recordings_manage',
            'type' => 1,
            'description' => 'Manage recording rules',
        ));

        // roles
        $this->insert('mcc_authitem', array(
            'name' => 'recordings',
            'type' => 2,
            'description' => 'Recordings Manager',
        ));

        // add links between items
        
        $this->insert('mcc_authitemchild', array('parent' => 'recordings', 'child' => 'recordings_manage'));
        $this->insert('mcc_authitemchild', array('parent' => 'recordings_manage', 'child' => 'recording_add'));
        $this->insert('mcc_authitemchild', array('parent' => 'recordings_manage', 'child' => 'recording_delete'));
        $this->insert('mcc_authitemchild', array('parent' => 'recordings_manage', 'child' => 'recording_modify'));

	}

	public function safeDown()
	{
        $this->delete('mcc_authitemchild');
        $this->delete('mcc_authitem');
	}
}
