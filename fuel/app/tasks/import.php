<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2015 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Tasks;

/**
 * クロールしたデータ等からインポート1
 *
 * @author     st2one
 * @copyright  Team Baavgai @Recruit-winter-intern
 */
class Import
{

	/**
	 * Rettyからクロールしたデータからインポートするためのスクリプト
	 * /pulib/csvフォルダにあるcsvファイルを全てスキャンする
	 * csvはショップごとに存在
	 *
	 * Usage (from command line):
	 *
	 * php oil r import:retty
	 */
	public static function retty()
	{
		// shop_id, shop_name, zip, address, longti, lati, url, tel, image, food_name, price, image_1, cat1, cat2, cat3, hp_url
		$csv_path = DOCROOT.'/public/csv/retty.csv';
		$file = new \SplFileObject($csv_path);
		$file->setFlags(\SplFileObject::READ_CSV);
		$records = array();
		foreach ($file as $line)
		{
			$records[] = $line;
		}

		$shop_ids = array();
		$shops = array();
		foreach ($records as $record)
		{
			if (count($record) < 2) {
				continue;
			}
			if ( ! array_key_exists($record[0], $shop_ids))
			{
				$shop = array();
				$shop['name'] = $record[1];
				$shop['zip'] = $record[2];
				$shop['address'] = $record[3];
				$shop['longti'] = $record[4];
				$shop['lati'] = $record[5];
				$shop['url'] = $record[5];
				$shop['tel'] = $record[6];
				$shop['image'] = $record[7];
				$shop_obj = \Model_Shop::forge($shop);
				if ( ! $shop_obj->save())
				{
					continue;
				}
				$shop_ids[$record[0]] = $shop_obj->id;
			}
			$shops[$shop_ids[$record[0]]][] = $record;
		}
		
		foreach ($shops as $shop_id => $records)
		{
			foreach ($records as $record)
			{
				// curlを使って画像を保存
				$url = $record[11];
				$image_info = new \SplFileInfo($url);
				$hashed_image_name = sha1($url.time()).'.'.$image_info->getExtension();
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$data = curl_exec($curl);
				if ( ! file_put_contents(DOCROOT.'public/upload/'.$hashed_image_name, $data)) {
					curl_close($curl);
					continue;
				}
				curl_close($curl);

				// トランザクション処理
				$db = \Database_Connection::instance();
				$db->start_transaction();

				try
				{
					// 画像をまずはそのまま保存しあとでリネームする
					$food = array();
					$food['name'] = $record[9];
					$food['shop_id'] = $shop_id;
					$food['price'] = $record[10];
					$food['image_1'] = $hashed_image_name;
					$food['cat1'] = $record[12];
					$food['cat2'] = $record[13];
					$food['cat3'] = $record[14];
					$food['tag1'] = '';
					$food['tag2'] = '';
					$food['tag3'] = '';
					$food['tag4'] = '';
					$food['tag5'] = '';
					$food_obj = \Model_Food::init($food);

					if (empty($food_obj))
					{
						throw new \Exception('料理の保存に問題が発生しました。');	
					}

					// ここで画像をリネーム（フォルダも作成）する
					$tmp_image_path = 'public/upload/'.$hashed_image_name;
					$shop_folder_path = 'public/image/'.$shop_id;
					$shop_folder_path1 = 'image/'.$shop_id;

					// shop_idフォルダをなければ作成
					if ( ! file_exists(DOCROOT.$shop_folder_path))
					{
						if ( ! mkdir(DOCROOT.$shop_folder_path, 0777))
						{
							return null;
						}
					}

					$image_new_path = $shop_folder_path.'/'.$food_obj->id.'.'.$image_info->getExtension();
					$image_new_path1 = $shop_folder_path1.'/'.$food_obj->id.'.'.$image_info->getExtension();
					if (rename(DOCROOT.$tmp_image_path, DOCROOT.$image_new_path))
					{
						$renamed_image_1 =  'http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/'.$image_new_path1;
					}
					else
					{
						throw new \Exception('画像のリネームに失敗しました。');
					}

					if (\Model_Food::update_image($food_obj->id, $renamed_image_1))
					{
						$db->commit_transaction();
						\Helper_Wa::import_food($food_obj->id);
					}
					else
					{
						throw new \Exception('画像のリネームに失敗しました。');
					}
				}
				catch (Exception $ex)
				{
					var_dump($ex);
					$db->rollback_transaction();
					continue;
				}
			}
		}
	}

}
