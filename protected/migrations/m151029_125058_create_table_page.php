<?php

class m151029_125058_create_table_page extends CDbMigration
{
	public function safeUp()
	{

		$this->createTable('page', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'title' => 'VARCHAR (500) not null',
            'subtitle' => 'VARCHAR (500)',
            'PRIMARY KEY (`id`)',
        ));
	}

	public function safeDown()
	{
		$this->dropTable('page');
	}
}