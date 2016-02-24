<?php

class Model_Admin extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields',
		'shop_id',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'admins';

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('username', 'Name', 'required|max_length[64]');
		return $val;
	}	
}
