<?php

class m151029_125251_create_table_page_x_user extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('page_x_user', array(
            'user_id' => 'int(11) not null',
            'page_id' => 'int(11) not null',
            'description' => 'varchar(500)',
        ));

        $this->addForeignKey('user_id', 'page_x_user', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('page_id', 'page_x_user', 'page_id', 'page', 'id', 'CASCADE', 'CASCADE');

        $this->addPrimaryKey('page_id_user_id', 'page_x_user', 'page_id, user_id');

	}

	public function safeDown()
	{
		$this->dropForeignKey('page_id', 'page_x_user');
		$this->dropForeignKey('user_id', 'page_x_user');

		$this->dropTable('page_x_user');
	}
}