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
		'url',
		'tel',
		'image_1',
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[64]');
		return $val;
	}

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

	/**
	 * 一時的にuploadにフォルダに保存した画像をshopフォルダに移動
	 * shop_id.拡張子を名前とする
	 * @param string $image_name
	 * @param int $shop_id
	 * @param int $food_id
	 * @return string or null
	 */
	public static function rename_image($image_name = null, $shop_id = null)
	{
		if (empty($image_name) || empty($shop_id))
		{
			return null;
		}
		$tmp_image_path = 'upload/'.$image_name;
		$shop_folder_path = 'shop';

		$image_info = new SplFileInfo($image_name);

		$image_new_path = $shop_folder_path.'/'.$shop_id.'.'.$image_info->getExtension();
		if (rename(DOCROOT.$tmp_image_path, DOCROOT.$image_new_path))
		{
			return HOST.$image_new_path;
		}
		return null;
	}

	/**
	 * 指定したshop_idのimageを更新する 
	 * @param int $shop_id
	 * @param string $renamed_image
	 * @return boolean
	 */
	public static function update_image($shop_id = null, $renamed_image = null)
	{
		if (empty($renamed_image))
		{
			return false;
		}
		$shop = Model_Shop::find($shop_id);
		if (empty($shop))
		{
			return false;
		}
		$shop->image_1 = $renamed_image;
		if ($shop->save())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}