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
	 * ひとまず料理を保存するために使う
	 * image_1には一時的なアップロード先を保存
	 * 後にrenameし移動させる
	 * @param type $input
	 * @return type
	 */
	public static function init($input = null)
	{
		if (empty($input)) {
			return array();		
		}
		// 画像をまずはそのまま保存しあとでリネームする
		$food = Model_Food::forge(array(
			'name' => $input['name'],
			'shop_id' => $input['shop_id'],
			'price' => $input['price'],
			'image_1' => $input['image_1'],
			'cat1' => $input['cat1'],
			'cat2' => $input['cat2'],
			'cat3' => $input['cat3'],
			'tag1' => $input['tag1'],
			'tag2' => $input['tag2'],
			'tag3' => $input['tag3'],
			'tag4' => $input['tag4'],
			'tag5' => $input['tag5'],
		));

		if ($food and $food->save())
		{	
			return $food;	
		}
		else
		{
			return array();
		}
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
		if ( ! file_exists($shop_folder_path))
		{
			if ( ! mkdir($shop_folder_path, 0777))
			{
				return null;
			}
		}

		$image_new_path = $shop_folder_path.'/'.$food_id.'.'.$image_info->getExtension();
		if (rename($tmp_image_path, $image_new_path))
		{
			return $image_new_path;
		}
		return null;
	}

	/**
	 * 指定したfood_idのimage_1を更新する 
	 * @param int $food_id
	 * @param string $renamed_image
	 * @return boolean
	 */
	public static function update_image($food_id = null, $renamed_image = null)
	{
		if (empty($renamed_image))
		{
			return false;
		}
		$food = Model_Food::find($food_id);
		if (empty($food))
		{
			return false;
		}
		$food->image_1 = $renamed_image;
		if ($food->save())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
