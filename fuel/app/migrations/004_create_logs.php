<?php

namespace Fuel\Migrations;

class Create_logs
{
	public function up()
	{
		\DBUtil::create_table('logs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'body' => array('type' => 'text'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('logs');
	}
}