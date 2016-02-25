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
class Test
{

	/**
	 * ESクエリーテスト
	 *
	 * Usage (from command line):
	 *
	 * php oil r remove:docs
	 */
	public static function init()
	{
		$tmp = json_decode('{"longitude":"465.000","latitude":"129.345","maxPrice":"1000","minPrice":"300"}');
		$body = [
			"longitude" => "139.7672030",
			"latitude" => "35.6814580",
			"maxPrice" => "1000",
			"minPrice" => "300"
			];
		$res = \Helper_Wa::get_initial($body, 10000, 4000);
		return json_encode($res);
	}
	public static function case1()
	{
		$maxPrice = 10000;
		$minPrice = 3000;
		$body = [
			"longitude" => "139.7672030",
			"latitude" => "35.6814580",
			"yes" => [],
			"no" => [
				"84" => [
					"category1" => "和食",
					"category2" => "すし・魚料理",
					"category3" => "うなぎ",
					"name" => "うな丼",
					"url" => "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/image/6923/84.jpg",
					"price" => 4000]]];
		$res = \Helper_Wa::get_response($body, $maxPrice, $minPrice);
		return json_encode($res);
		
	}
	public static function case2()
	{
		$maxPrice = 10000;
		$minPrice = 3000;
		$body = [
			"longitude" => "139.7672030",
			"latitude" => "35.6814580",
			"yes" => [
				"65" => [
					"category1" => "和食",
					"category2" => "すし・魚料理",
					"category3" => "オイスターバー",
					"name" => "カキフライ",
					"url" => "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/image/6905/65.jpg"
				],
				"11" => [
					"category1" => "和食",
					"category2" => "すし・魚料理",
					"category3" => "寿司",
					"name" => "赤身細巻き",
					"url" => "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/image/6862/11.jpg"
				]
			],
			"no" => [
				"84" => [
					"category1" => "和食",
					"category2" => "すし・魚料理",
					"category3" => "うなぎ",
					"name" => "うな丼",
					"url" => "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/image/6923/84.jpg",
					"price" => 4000]]];
		$res = \Helper_Wa::get_response($body, $maxPrice, $minPrice);
		return json_encode($res);

	}
	public static function case3()
	{
		$maxPrice = 10000;
		$minPrice = 3000;
		$body = [
			"longitude" => "139.7672030",
			"latitude" => "35.6814580",
			"no" => [
				"65" => [
					"category1" => "和食",
					"category2" => "すし・魚料理",
					"category3" => "オイスターバー",
					"name" => "カキフライ",
					"url" => "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/image/6905/65.jpg"
				],
				"11" => [
					"category1" => "和食",
					"category2" => "すし・魚料理",
					"category3" => "寿司",
					"name" => "赤身細巻き",
					"url" => "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/image/6862/11.jpg"
				]
			],
			"yes" => [
				"84" => [
					"category1" => "和食",
					"category2" => "すし・魚料理",
					"category3" => "うなぎ",
					"name" => "うな丼",
					"url" => "http://ec2-52-25-104-208.us-west-2.compute.amazonaws.com/image/6923/84.jpg",
					"price" => 4000]]];
		$res = \Helper_Wa::get_response($body, $maxPrice, $minPrice);
		return json_encode($res);


	}
}
