<?php

class Controller_Shop extends Controller_Base
{
	public function before()
	{
		parent::before();
		!Auth::check() and Response::redirect('login');
		$this->template->subtitle = '';
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('shop');

		if ( ! $data['shop'] = Model_Shop::find($id))
		{
			Session::set_flash('error', 'Shopのレコードが見つかりません #'.$id);
			Response::redirect('admin/login');
		}

		$this->template->title = "Shop";
		$this->template->content = View::forge('shop/view', $data);

	}
}
