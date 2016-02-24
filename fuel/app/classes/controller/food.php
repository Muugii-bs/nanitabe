<?php

class Controller_Food extends Controller_Base
{

	public function before()
	{
		parent::before();
		//すでにログイン済であればログイン後のページへリダイレクト
		!Auth::check() and Response::redirect('login');
		$this->template->subtitle = '';
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('home');

		if (!$data['food'] = Model_Food::find($id))
		{
			Session::set_flash('error', '料理が見つかりません #' . $id);
			Response::redirect('product');
		}

		$this->template->title = "料理";
		$this->template->content = View::forge('food/view', $data);
	}

	public function action_create()
	{
		$this->template->title = "料理新規登録";
		$this->template->content = View::forge('food/create');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('home');

		$food = Model_Food::find($id);
		if ($food)
		{
			$food->delete();

			Session::set_flash('success', 'Deleted product #' . $id);
		} else
		{
			Session::set_flash('error', 'Could not delete product #' . $id);
		}

		Response::redirect('home');
	}

}
