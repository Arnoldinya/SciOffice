<?php

class m151029_121553_create_table_auth_tables extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('AuthItem', array(
            'name' => 'varchar(64) not null',
            'type' => 'integer not null',
            'description' => 'text',
            'bizrule' => 'text',
            'data' => 'text',
            'PRIMARY KEY (`name`)',
        ));

		$this->createTable('AuthItemChild', array(
            'parent' => 'varchar(64) not null',
            'child' => 'varchar(64) not null',
        ));

        $this->addForeignKey('parent', 'AuthItemChild', 'parent', 'AuthItem', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('child', 'AuthItemChild', 'child', 'AuthItem', 'name', 'CASCADE', 'CASCADE');

		$this->createTable('AuthAssignment', array(
            'itemname' => 'varchar(64) not null',
            'userid' => 'varchar(64) not null',
            'bizrule' => 'text',
            'data' => 'text',
            'PRIMARY KEY (`itemname`, `userid`)',
        ));

        $this->addForeignKey('itemname', 'AuthAssignment', 'itemname', 'AuthItem', 'name', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropForeignKey('itemname', 'AuthAssignment');
		$this->dropForeignKey('parent', 'AuthAssignment');
		$this->dropForeignKey('child', 'AuthAssignment');

		$this->dropTable('AuthAssignment');
		$this->dropTable('AuthItemChild');
		$this->dropTable('AuthItem');
	}
}