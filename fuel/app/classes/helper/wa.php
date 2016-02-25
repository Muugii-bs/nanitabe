<?php

class Helper_Wa
{
	const MY_DOMAIN = "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/";
	const BIAS_CAT1 = 4;
	const BIAS_CAT2 = 3;
	const BIAS_CAT3 = 2;

	public static function wa_initialize() {
//{{{1
		$index = "nanitabe";
		$type = "foods";
		$mapping = [
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
		\Helper_Es::create_index($index, $type, $mapping);
//}}}1
	}
		
	public static function get_initial($request) {
//{{{2
		$res = [];
		$longti = $request["longitude"];
		$lati = $request["latitude"];
		$max_price = $request["maxPrice"];
		$min_price = $request["minPrice"];
		$must = [];
		$must[] = [
			"range" => [
				"price" => [
					"gte" => $min_price,
					"lte" => $max_price]]];
		$must[] = [
			"geo_distance" => [
				"distance" => "0.5km",
				"pin.location" => [
					"lon" => $longti,
					"lat" => $lati]]];
		$query = [
			"timeout" => "20000ms",
			"from" => 0,
			"size" => 100,
			"query" => [
				"filtered" => [
					"query" => [
						"match_all" => []
					],
					"filter" => [
						"bool" => [
							"must" => $must
						]
					]
				],
				"sort" => [
					"yes_score" => [
						"order" => "desc",
					],
					"_score"
				]
			]
		];
		$res = \Helper_Es::execute_query($query);
		$tmp = [];
		foreach($res["hits"]["hits"] as $hit) {
			$tmp[] = [
				$hit["_source"]["food_id"] => [
					"url" => $hit["_source"]["image_path"],
					"category1" => $hit["_source"]["cat1"],
					"category2" => $hit["_source"]["cat2"],
					"category3" => $hit["_source"]["cat3"],
					"name" => $hit["_source"]["name"],
					"price" => $hit["_source"]["price"]]];
		}	
		$rand_res = [
			"food" => [],
			"result" => []];
		$rand_keys = array_rand($tmp, 10);
		foreach($rand_keys as $key) {
			$rand_res["food"][] = $tmp[$key];
		}	
		return $rand_res;
//}}}2
	}

	public static function get_response($request, $max_price, $min_price) {
//{{{3
		$yes = $request["yes"];
		$no = $request["no"];
		$longti = $request["longitude"];
		$lati = $request["latitude"];
		$res = [];
		$res["result"] = \Helper_Wa::get_result($yes);
		if(count($yes) == 0) {
			$res = \Helper_Wa::get_initial($request);
		} else if(count($yes) < count($no)) {
			$res["food"] = \Helper_Wa::get_food($longti, $lati, $max_price, $min_price, $yes, $no);
			$res["result"] = \Helper_Wa::get_result($yes);
		} else {
			$res["food"] = \Helper_Wa::get_filtered_food($longti, $lati, $max_price, $min_price, $yes, $no);
			$res["result"] = \Helper_Wa::get_result($yes);
		}
		return $res;
//}}}3
	}	

	public static function get_food($longti, $lati, $max_price, $min_price, $yes, $no) {
//{{{4
		$query = \Helper_Wa::get_basic_query($longti, $lati, $max_price, $min_price, $yes, $no);
		$food = \Helper_Wa::get_basic_res($query);
		return $food;
//}}}4
	}

	public static function get_basic_res($query) {
//{{{5
		$res = \Helper_Es::execute_query($query);
		$res = $res["hits"]["hits"][0]["_source"];
		$food = [
			$res["food_id"] => [
				"name" => $res["name"],
				"url" => $res["image_path"],
				"price" => $res["price"],
				"category1" => $res["cat1"],
				"category2" => $res["cat2"],
				"category3" => $res["cat3"]]];
		return $food;
//}}}5
	}

	public static function get_filtered_food($longti, $lati, $max_price, $min_price, $yes, $no) {
//{{{6
		$query = \Helper_Wa::get_basic_query($longti, $lati, $max_price, $min_price, $yes, $no);
		$must_not = $query["filtered"]["filter"]["bool"]["must_not"];
		$black_list = \Helper_Wa::get_black_list($no);
		foreach($black_list["cat1"] as $cat1) {
			$match = [
				"match" => [
					"cat1" => $cat1]];
			$must_not[] = $match;
		}
		foreach($black_list["cat2"] as $cat2) {
			$match = [
				"match" => [
					"cat2" => $cat2]];
			$must_not[] = $match;
		}
		foreach($black_list["cat3"] as $cat3) {
			$match = [
				"match" => [
					"cat3" => $cat3]];
			$must_not[] = $match;
		}
		$query["filtered"]["filter"]["bool"]["must_not"] = $must_not;
		$food = \Helper_Wa::get_basic_res($query);
		return $food;
//}}}6
	}

	public static function get_black_list($no) {
//{{{7
		$black_list = [
			"cat1" => [],
			"cat2" => [],
			"cat3" => []];
		$cat1 = [];
		$cat2 = [];
		$cat3 = [];
		foreach($no as $id => $body) {
			if(!$cat1[$body["category1"]]) {
				$cat1[$body["category1"]] = 1;
			} else {
				$cat1[$body["category1"]] ++;
			}
			if(!$cat2[$body["category2"]]) {
				$cat2[$body["category2"]] = 1;
			} else {
				$cat2[$body["category2"]] ++;
			}
			if(!$cat3[$body["category3"]]) {
				$cat3[$body["category3"]] = 1;
			} else {
				$cat3[$body["category3"]] ++;
			}
		}
		foreach($cat1 as $i => $c) {
			if($c >= self::BIAS_CAT1) {
				$black_list["cat1"][] = $i;
			}
		}
		foreach($cat2 as $i => $c) {
			if($c >= self::BIAS_CAT2) {
				$black_list["cat2"][] = $i;
			}
		}
		foreach($cat3 as $i => $c) {
			if($c >= self::BIAS_CAT3) {
					$black_list["cat3"][] = $i;
			}
		}
		return $black_list;
//}}}7
	}

	public static function get_basic_query($longti, $lati, $max_price, $min_price, $yes, $no) {
//{{{8
		$query = [
			"timeout" => "20000ms",
			"from" => 0,
			"size" => 1,
			"filtered" => [
				"query" => [
					"bool" => [
						"must" => [
							"match_all" => []
						],
						"should" => []
					]
				],
				"filter" => []]];
		$must_not = [];
		foreach($yes as $id => $body) {
			$match = [
				"match" => [
					"food_id" => $id]];
			$must_not[] = $match;
		}
		foreach($no as $id => $body) {
			$match = [
				"match" => [
					"bood_id" => $id]];
			$must_not[] = $match;
		}
		$filter = [
			"bool" => [
				"must" => [
					"range" => [
						"price" => [
							"gte" => $min_price,
							"lte" => $max_price
						]
					],
					"geo_distance" => [
						"distance" => "0.5km",
						"pin.location" => [
							"lon" => $longti,
							"lat" => $lati]]
				],
				"must_not" => $must_not]];
		$should = [];
		foreach($yes as $id => $body) {
			$tmp = [
				"match" => [
					"cat3" => [
						"query" => $body["category3"],
						"boost" => 4]]];
			$should[] = $tmp;
			$tmp = [
				"match" => [
					"cat3" => [
						"query" => $body["category2"],
						"boost" => 3]]];
			$should[] = $tmp;
			$tmp = [
				"match" => [
					"cat3" => [
						"query" => $body["category1"],
						"boost" => 2]]];
			$should[] = $tmp;
		}
		$query["filtered"]["query"]["bool"]["should"] = $should;
		$query["filtered"]["filter"] = $filter;
		return $query;
//}}}8
	}

	public static function get_result($yes) {
//{{{9
		$query = [
			"timeout" => "20000ms",
			"from" => 0,
			"size" => 100,
			"query" => [
				"bool" => [
					"should" => []]]];
		$should = [];
		foreach($yes as $id => $body) {
			$match = [
				"match" => [
					"food_id" => $id]];
			$should[] = $match;
		}	
		$query["query"]["bool"]["should"] = $should;
		$res = \Helper_Es::execute_query($query);
		$result = [];
		foreach($res["hits"]["hits"] as $hit) {
			$tmp = [
				$hit["_source"]["shop_id"] => [
					"name" => $hit["_source"]["shop_name"],
					"tel" => $hit["_source"]["shop_tel"],
					"image" => $hit["_source"]["shop_image"],
					"zip" => $hit["_source"]["shop_zip"],
					"address" => $hit["_source"]["shop_address"],
					"url" => $hit["_source"]["shop_url"],
					"food" => [
						"name" => $hit["_source"]["name"],
						"image" => $hit["_source"]["image_path"],
						"price" => $hit["_source"]["price"],
						"yes" => $hit["_source"]["yes_score"]]]];
			$result[] = $tmp;
		}
		return $result;
//}}}9
	}

	public static function import_food($id) {
//{{{10
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
			"created" => (string)$food["created"],
			"image_path" => $food["image_1"],
			"pin" => [
				"location" => [
					"lat" => $shop["lati"],
					"lon" => $shop["longti"],
				]
			],
			"price" => (int)$food["price"],
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
		return \Helper_Es::import_document($index, $type, $id, $doc);
//}}}10
	}

	public static function delete_document($id) {
//{{{11
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
			"created" => (string)$food["created"],
			"image_path" => $food["image_1"],
			"pin" => [
				"location" => [
					"lat" => $shop["lati"],
					"lon" => $shop["longti"],
				]
			],
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
		return \Helper_Es::delete_document($index, $type, $id, $doc);
//}}}11
	}
}


