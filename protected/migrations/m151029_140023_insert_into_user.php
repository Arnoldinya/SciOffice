<?php

class m151029_140023_insert_into_user extends CDbMigration
{
	public function safeUp()
	{
        $this->insert('user', array(
        	'login' => 'test',
        	'password' => 'test',
        	'surname' => 'Иванов',
        	'name' => 'Иван',
        	'patronymic' => 'Иванович',
        ));

        $this->insert('user', array(
        	'login' => 'test1',
        	'password' => 'test2',
        	'surname' => 'Петров',
        	'name' => 'Петр',
        	'patronymic' => 'Петрович',
        ));
	}

	public function safeDown()
	{
	}
}