<?php

class Helper_Wa
{
	public static function wa_initialize() {
		$index = "nanitabe";
		$type = "foods";
		$mapping = array(
//{{{1			
			"food_id" => array(
				"type" => "integer",
				),
			"shop_id" => array(
				"type" => "integer",
				),
			"name" => array(
				"type" => "string",
				),
			"price" => array(
				"type" => "integer",
				),
			"image_path" => array(
				"type" => "string",
				"index" => "not_analyzed",
				),
			"longti" => array(
				"type" => "double",
				),
			"lati" => array(
				"type" => "double",
				),
			"cat1" => array(
				"type" => "string",
				),
			"cat2" => array(
				"type" => "string",
				),
			"cat3" => array(
				"type" => "string",
				),
			"cat4" => array(
				"type" => "string",
				),
			"cat5" => array(
				"type" => "string",
				),
			"cat6" => array(
				"type" => "string",
				),
			"tag1" => array(
				"type" => "string",
				),
			"tag2" => array(
				"type" => "string",
				),
			"tag3" => array(
				"type" => "string",
				),
			"tag4" => array(
				"type" => "string",
				),
			"tag5" => array(
				"type" => "string",
				),
			"tag6" => array(
				"type" => "string",
				),
			"tag7" => array(
				"type" => "string",
				),
			"tag8" => array(
				"type" => "string",
				),
			"tag9" => array(
				"type" => "string",
				),
			"tag10" => array(
				"type" => "string",
				),
			"created" => array(
				"type" => "string",
				),
			"updated" => array(
				"type" => "string",
				),
			);
//}}}1
		\Helper_Es::create_index($index, $type, $mapping);
	}
		
	public static function get_initial($last, $query) {
		$res = array();
		return $res;
	}

	public static function import_food($id) {
		$index = 'nanitabe';
		$type = 'foods';
		$food = \Model_Food::find($id);
		$shop = \Model_Shop::find($food["shop_id"]);
		$doc = array(
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
			//"created" => $food["created"],
			"image_path" => $food["image_1"],
			//"lati" => $food["lati"],
			//"longti" => $food["longti"],
			"price" => $food["price"],
			"updated" => $food["updated"],
			"shop_name" => $shop["name"],
			"shop_address" => $shop["address"],
			"shop_category" => $shop["category"],
			"shop_zip" => $shop["zip"],
			//"shop_image" => $shop["image"],
		);	
		return \Helper_Es::import_document($index, $type, $id, $doc);
	}
}


