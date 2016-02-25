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
 *
 * @author     Mugi
 * @copyright  Team Baavgai @Recruit-winter-intern
 */
class Remove
{

	/**
	 * ESからすべてのドキュメントを削除
	 *
	 * Usage (from command line):
	 *
	 * php oil r remove:docs
	 */
	public static function docs()
	{
		$index = 'nanitabe';
		$type = 'foods';
		$foods = \Model_Food::find('all');
		foreach($foods as $food) {
			$shop = \Model_Shop::find($food["shop_id"]);
			$doc = [
				"food_id" => $food["id"],
				"name" => $food["name"],
				"shop_id" => $food["shop_id"],
				"cat1" => $food["cat1"],
				"cat2" => $food["cat2"],
				"cat3" => $food["cat3"],
				"tag1" => $food["tag1"],
				"tag2" => $food["tag2"],
				"tag3" => $food["tag3"],
				"tag4" => $food["tag4"],
				"tag5" => $food["tag4"],
				"yes_score" => $food["yes"],
				"no_score" => $food["no"],
				"food_score" => $food["score"],
				"created" => (string)$food["created"],
				"image_path" => $food["image_1"],
				"lati" => $food["lati"],
				"longti" => $shop["longti"],
				"price" => (int)$shop["price"],
				"updated" => (string)$food["updated"],
				"shop_name" => $shop["name"],
				"shop_address" => $shop["address"],
				"shop_category" => $shop["category"],
				"shop_zip" => $shop["zip"],
				"shop_image" => $shop["image_1"],
				"shop_url" => $shop["url"],
				"shop_tel" => $shop["tel"],
				"shop_score" => $food["score"]
			];
			return \Helper_Es::delete_document($index, $type, $food["id"], $doc);
		}
	}
}
