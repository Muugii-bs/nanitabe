<?php
class Controller_Home extends Controller_Base
{
	public function before()
	{
		parent::before();
		
		//すでにログイン済であればログイン後のページへリダイレクト
		!Auth::check() and Response::redirect('admin/login');
		$this->template->subtitle = '';
	}
	
	
	public function action_index()
	{
		$shop = Model_Shop::find($this->current_admin['shop_id']);
		
		// TODO ページネーション
		$foods = Model_Food::find('all', array(
			'where' => array(
				array('shop_id', $shop->id,)
			)
		));

		$data = array();
		$data['shop'] = $shop;
		$data['foods'] = $foods;

		$this->template->title = "ホーム";
		$this->template->content = View::forge('home/index', $data);
	}
}