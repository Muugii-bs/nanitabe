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
		if (Input::method() == 'POST')
		{
			// トランザクション処理
			$db = Database_Connection::instance();
			$db->start_transaction();

			try
			{
				$val = Model_Food::validate('create');

				if ($val->run())
				{
					// 画像をまずはそのまま保存しあとでリネームする
					$food = Input::post();
					$food_obj = Model_Food::init($food);

					if (empty($food_obj))
					{
						throw new Exception('料理の保存に問題が発生しました。');	
					}
					// ここで画像をリネーム（フォルダも作成）する
					$renamed_image_1 = Model_Food::rename_image($food_obj->image_1, $food_obj->shop_id, $food_obj->id);

					if (Model_Food::update_image($food_obj->id, $renamed_image_1))
					{
						$db->commit_transaction();
						Session::set_flash('success', '料理の登録に成功しました #' . $food_obj->id . '.');
						Response::redirect('home');
					}
					else
					{
						throw new Exception('画像のリネームに失敗しました。');
					}
				}
				else
				{
					throw new Exception($val->error());
				}
			}
			catch (Exception $ex)
			{
				Session::set_flash('error', $ex->getMessage());
				$db->rollback_transaction();
			}
		}
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
