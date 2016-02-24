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
		$data = array();
		$data['shop'] = Model_Shop::find($this->current_admin['shop_id']);
		
		// TODO foodsの取得

		$this->template->title = "Users";
		$this->template->content = View::forge('home/index', $data);
	}
}
