<?php

class m151029_115306_create_table_user extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'login' => 'VARCHAR (500) not null',
            'password' => 'VARCHAR (500) not null',
            'surname' => 'VARCHAR (500) not null',
            'name' => 'VARCHAR (500) not null',
            'patronymic' => 'VARCHAR (500)',
            'PRIMARY KEY (`id`)',
        ));

        $this->insert('user', array(
        	'login' => 'admin',
        	'password' => 'admin',
        	'surname' => 'admin',
        	'name' => 'admin',
        	'patronymic' => 'admin',
        ));

        $this->insert('user', array(
        	'login' => 'demo',
        	'password' => 'demo',
        	'surname' => 'demo',
        	'name' => 'demo',
        	'patronymic' => 'demo',
        ));
	}

	public function safeDown()
	{
		$this->dropTable('user');
	}
}