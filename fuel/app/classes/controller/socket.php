<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @author     Mugi 
 * @copyright  Team Baavgai @Recruit-winter-intern
 */

class Controller_Socket extends Controller
{
	public function action_index()
	{
		$view = View::forge('test');
		return Response::forge($view);
	}

	public function action_es()
	{
		$res = \Helper_Wa::import_food(1);
		return print_r($res);
	}

}
