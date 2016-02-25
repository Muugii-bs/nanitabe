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
		$res = \Helper_Wa::get_initial($body);
		return json_encode($res);
	}
}
