<?php

namespace Fuel\Migrations;

class Create_foods
{
	public function up()
	{
		\DBUtil::create_table('foods', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 100, 'type' => 'varchar'),
			'shop_id' => array('constraint' => 8, 'type' => 'int'),
			'price' => array('constraint' => 11, 'type' => 'int'),
			'yes' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'no' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'score' => array('type' => 'double', 'null' => true),
			'image_1' => array('constraint' => 255, 'type' => 'varchar'),
			'cat1' => array('constraint' => 100, 'type' => 'varchar'),
			'cat2' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'cat3' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'tag1' => array('constraint' => 100, 'type' => 'varchar'),
			'tag2' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'tag3' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'tag4' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'tag5' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'created_at' => array('constraint' => 8, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 8, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('foods');
	}
}
