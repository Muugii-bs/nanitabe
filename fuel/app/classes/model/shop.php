<?php

class Model_Shop extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'zip',
		'address',
		'longti',
		'lati',
		'category',
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

	protected static $_table_name = 'shops';

	/**
	 * 
	 * @param type $name
	 * @return type
	 */
	public static function init($name = null)
	{
		if (empty($name))
		{
			return array();
		}

		$shop['name'] = $name;
		$shop_obj = Model_Shop::forge($shop);
		if ( ! $shop_obj->save())
		{
			return array();
		}
		return $shop_obj;
	}
}