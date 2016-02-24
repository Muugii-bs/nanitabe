<?php

use Orm\Model;

class Model_Food extends Model
{

	protected static $_properties = array(
		'id',
		'name',
		'shop_id',
		'price',
		'image_1',
		'cat1',
		'cat2',
		'cat3',
		'tag1',
		'tag2',
		'tag3',
		'tag4',
		'tag5',
		'created_at',
		'updated_at',
	);
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[64]');
		$val->add_field('shop_id', 'Shop id', 'required|valid_string[numeric]');
		$val->add_field('price', 'Price', 'required|valid_string[numeric]');
		return $val;
	}

	/**
	 * 一時的にuploadにフォルダに保存した画像をshop_idフォルダに移動
	 * food_id.拡張子を名前とする
	 * @param string $image_name
	 * @param int $shop_id
	 * @param int $food_id
	 * @return string or null
	 */
	public static function rename_image($image_name = null, $shop_id = null, $food_id = null)
	{
		if (empty($image_name) || empty($shop_id) || empty($food_id))
		{
			return null;
		}
		$tmp_image_path = DOCROOT . 'upload/'.$image_name;
		$shop_folder_path = DOCROOT . 'image/'.$shop_id;

		$image_info = new SplFileInfo($image_name);

		// shop_idフォルダをなければ作成
		if (file_exists($shop_folder_path))
		{
			if ( ! mkdir($shop_folder_path, 0777))
			{
				return null;
			}
		}

		$image_new_path = $shop_folder_path.'/'.$image_info->getExtension();
		if (rename($tmp_image_path, $image_new_path))
		{
			return $image_new_path;
		}
		return null;
	}

}
