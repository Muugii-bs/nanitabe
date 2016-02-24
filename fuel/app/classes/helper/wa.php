<?php

class Helper_Wa
{
	const DOMAIN = "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/";

	public static function wa_initialize() {
		$index = "nanitabe";
		$type = "foods";
		$mapping = [
//{{{1			
			"food_id" => [
				"type" => "integer",
				],
			"shop_id" => [
				"type" => "integer",
				],
			"name" => [
				"type" => "string",
				],
			"price" => [
				"type" => "integer",
				],
			"image_path" => [
				"type" => "string",
				"index" => "not_analyzed",
				],
			"longti" => [
				"type" => "double",
				],
			"lati" => [
				"type" => "double",
				],
			"cat1" => [
				"type" => "string",
				],
			"cat2" => [
				"type" => "string",
				],
			"cat3" => [
				"type" => "string",
				],
			"cat4" => [
				"type" => "string",
				],
			"cat5" => [
				"type" => "string",
				],
			"cat6" => [
				"type" => "string",
				],
			"tag1" => [
				"type" => "string",
				],
			"tag2" => [
				"type" => "string",
				],
			"tag3" => [
				"type" => "string",
				],
			"tag4" => [
				"type" => "string",
				],
			"tag5" => [
				"type" => "string",
				],
			"tag6" => [
				"type" => "string",
				],
			"tag7" => [
				"type" => "string",
				],
			"tag8" => [
				"type" => "string",
				],
			"tag9" => [
				"type" => "string",
				],
			"tag10" => [
				"type" => "string",
				],
			"created" => [
				"type" => "string",
				],
			"updated" => [
				"type" => "string",
				],
			];
//}}}1
		\Helper_Es::create_index($index, $type, $mapping);
	}
		
	public static function get_initial($request) {
		$res = [];
		$longti = $request["longti"];
		$lati = $request["lati"];
		$price = $request["price"];
		$query = [
			"timeout" => 20 * 1000,
			"from" => 0,
			"size" => 10,
			"filtered" => [
				"sort" => [
					"yes_score" => [
						"order" => "desc",
					],
					"_score",
				],
				"query" => [
					"match_all" => []
				],
				"filter" => [
					"bool" => [
						"must" => [
							"range" => [
								"price" => [
									"lt" => $price,
								]
							],
							"geo_distance_range" => [
								"from" => "0km",
								"to" => "0.5km",
								"pin.location" => [
									"lat" => $lati,
									"lon" => $longti
								]]]]]]];
		$res = \Helper_Es::execute_query($query);
		foreach($res["hits"]["hits"] as $hit) {
			$pics[] = DOMAIN . $hit["image_path"];
		}	
		return $pics;
	}

	public static function get_request($query) {
		$res = [];
		return $res;
	}	

	public static function import_food($id) {
		$index = 'nanitabe';
		$type = 'foods';
		$food = \Model_Food::find($id);
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
		];	
		return \Helper_Es::import_document($index, $type, $id, $doc);
	}

	public static function delete_document($id) {
		$index = 'nanitabe';
		$type = 'foods';
		$food = \Model_Food::find($id);
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
		];	
		return \Helper_Es::delete_document($index, $type, $id, $doc);
	}
}


