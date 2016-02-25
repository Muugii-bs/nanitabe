<?php

class Controller_Base extends Controller_Template
{
	public function before()
	{
		parent::before();
		
		// http://madroom-project.blogspot.jp/2012/09/fuelphpassetassets.html
		// adminLTEをsetする
		Asset::add_path('assets/dist/', 'css');
		Asset::add_path('assets/dist/', 'js');
		Asset::add_path('assets/dist/', 'img');

		// Assign current_user to the instance so controllers can use it
		$current_admin = Auth::check() ? Model_Admin::find_by_username(Auth::get_screen_name()) : null;
		$this->current_admin = array();
		$this->current_admin['id'] = $current_admin['id'];
		$this->current_admin['username'] = $current_admin['username'];
		$this->current_admin['group'] = $current_admin['group'];
		$this->current_admin['email'] = $current_admin['email'];
		$this->current_admin['shop_id'] = $current_admin['shop_id'];
		if (!empty($this->current_admin['shop_id']))
		{
			$shop = Model_Shop::find($this->current_admin['shop_id']);
			$this->current_admin['image'] = $shop->image_1;
			$this->current_admin['shop_name'] = $shop->name;
		}

		// Set a global variable so views can use it
		View::set_global('current_admin', $this->current_admin);
	}

}
