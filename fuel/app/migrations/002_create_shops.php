<?php

namespace Fuel\Migrations;

class Create_shops
{
	public function up()
	{
		\DBUtil::create_table('shops', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 100, 'type' => 'varchar'),
			'zip' => array('constraint' => 20, 'type' => 'varchar', 'null' => true),
			'address' => array('constraint' => 200, 'type' => 'varchar', 'null' => true),
			'longti' => array('type' => 'double', 'null' => true),
			'lati' => array('type' => 'double', 'null' => true),
			'url' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'tel' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'image' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'category' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('shops');
	}
}
