<?php

class m140529_115710_add_auth_items extends CDbMigration
{
	public function up()
	{
        // column type: Role=2, Task=1, Operation=0
        $this->truncateTable('mcc_authitemchild');
        $this->delete('mcc_authitem');
        $this->truncateTable('mcc_authassignment');
        // roles

        $this->insert('mcc_authitem', array(
            'name' => 'admin',
            'type' => 2,
            'description' => 'Admin has access to everything.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'full_user',
            'type' => 2,
            'description' => 'Full user has access to all interfaces and operations except administration ones.',
        ));
        
        $this->insert('mcc_authitem', array(
            'name' => 'readonly_user',
            'type' => 2,
            'description' => 'Readonly user has access to all information but cannot change anything.',
        ));

        // tasks
        
        $this->insert('mcc_authitem', array(
            'name' => 't_recordings_all',
            'type' => 1,
            'description' => 'Read and write access to all recordings interfaces.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 't_guide_all',
            'type' => 1,
            'description' => 'Read and write access to all guide interfaces.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 't_status_all',
            'type' => 1,
            'description' => 'Read and write access to all status interfaces.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 't_recordings_view',
            'type' => 1,
            'description' => 'Read access to all recordings interfaces.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 't_guide_view',
            'type' => 1,
            'description' => 'Read access to all guide interfaces.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 't_status_view',
            'type' => 1,
            'description' => 'Read access to all status interfaces.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 't_admin_all',
            'type' => 1,
            'description' => 'Read and write access to all admin interfaces.',
        ));

        // operations
        $this->insert('mcc_authitem', array(
            'name' => 'o_recorded_view',
            'type' => 0,
            'description' => 'View recorded.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_upcoming_view',
            'type' => 0,
            'description' => 'View upcoming.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_archive_use',
            'type' => 0,
            'description' => 'Use archive.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_guide_view',
            'type' => 0,
            'description' => 'View guide.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_record_rule_add',
            'type' => 0,
            'description' => 'Add record rule.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_record_rule_del',
            'type' => 0,
            'description' => 'Delete record rule.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_status_backend_view',
            'type' => 0,
            'description' => 'View backend status information.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_status_tuner_view',
            'type' => 0,
            'description' => 'View tuner status information.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_status_storage_view',
            'type' => 0,
            'description' => 'View storage status information.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_manage_users',
            'type' => 0,
            'description' => 'Manage users.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_manage_assignments',
            'type' => 0,
            'description' => 'Manage assignments.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_manage_roles',
            'type' => 0,
            'description' => 'Manage roles.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_manage_tasks',
            'type' => 0,
            'description' => 'Manage tasks.',
        ));

        $this->insert('mcc_authitem', array(
            'name' => 'o_manage_operations',
            'type' => 0,
            'description' => 'Manage operations.',
        ));

        // add links between items
       
        // roles <-> tasks
        $this->insert('mcc_authitemchild', array('parent' => 'admin', 'child' => 't_admin_all'));

        $this->insert('mcc_authitemchild', array('parent' => 'full_user', 'child' => 't_recordings_all'));
        $this->insert('mcc_authitemchild', array('parent' => 'full_user', 'child' => 't_guide_all'));
        $this->insert('mcc_authitemchild', array('parent' => 'full_user', 'child' => 't_status_all'));

        $this->insert('mcc_authitemchild', array('parent' => 'readonly_user', 'child' => 't_recordings_view'));
        $this->insert('mcc_authitemchild', array('parent' => 'readonly_user', 'child' => 't_guide_view'));
        $this->insert('mcc_authitemchild', array('parent' => 'readonly_user', 'child' => 't_status_view'));

        // tasks <-> operations
        $this->insert('mcc_authitemchild', array('parent' => 't_admin_all', 'child' => 'o_manage_users'));
        $this->insert('mcc_authitemchild', array('parent' => 't_admin_all', 'child' => 'o_manage_assignments'));
        $this->insert('mcc_authitemchild', array('parent' => 't_admin_all', 'child' => 'o_manage_roles'));
        $this->insert('mcc_authitemchild', array('parent' => 't_admin_all', 'child' => 'o_manage_tasks'));
        $this->insert('mcc_authitemchild', array('parent' => 't_admin_all', 'child' => 'o_manage_operations'));

        $this->insert('mcc_authitemchild', array('parent' => 't_recordings_all', 'child' => 'o_recorded_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_recordings_all', 'child' => 'o_upcoming_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_recordings_all', 'child' => 'o_archive_use'));

        $this->insert('mcc_authitemchild', array('parent' => 't_guide_all', 'child' => 'o_guide_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_guide_all', 'child' => 'o_record_rule_add'));
        $this->insert('mcc_authitemchild', array('parent' => 't_guide_all', 'child' => 'o_record_rule_del'));

        $this->insert('mcc_authitemchild', array('parent' => 't_status_all', 'child' => 'o_status_backend_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_status_all', 'child' => 'o_status_tuner_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_status_all', 'child' => 'o_status_storage_view'));

        $this->insert('mcc_authitemchild', array('parent' => 't_recordings_view', 'child' => 'o_recorded_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_recordings_view', 'child' => 'o_upcoming_view'));

        $this->insert('mcc_authitemchild', array('parent' => 't_guide_view', 'child' => 'o_guide_view'));

        $this->insert('mcc_authitemchild', array('parent' => 't_status_view', 'child' => 'o_status_backend_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_status_view', 'child' => 'o_status_tuner_view'));
        $this->insert('mcc_authitemchild', array('parent' => 't_status_view', 'child' => 'o_status_storage_view'));
	}

	public function down()
	{
		echo "m140529_115710_add_auth_items does not support migration down.\n";
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
