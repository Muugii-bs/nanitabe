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

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('home');

		if ( ! $food_obj = Model_Food::find($id))
		{
			Session::set_flash('error', '料理レコードが見つかりません。 # ' . $id);
			Response::redirect(Input::referrer() == '' ? '/' : Input::referrer());
		}

		$data = array();
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
					$food_obj->name = Input::post('name');
					$food_obj->shop_id = Input::post('shop_id');
					$food_obj->price = Input::post('price');
					$food_obj->image_1 = Input::post('image_1');
					$food_obj->cat1 = Input::post('cat1');
					$food_obj->cat2 = Input::post('cat2');
					$food_obj->cat3 = Input::post('cat3');
					$food_obj->tag1 = Input::post('tag1');
					$food_obj->tag2 = Input::post('tag2');
					$food_obj->tag3 = Input::post('tag3');
					$food_obj->tag4 = Input::post('tag4');
					$food_obj->tag5 = Input::post('tag5');

					if ( ! $food_obj->save())
					{
						throw new Exception('料理の保存に問題が発生しました。');	
					}
					// ここで画像をリネーム（フォルダも作成）する
					if (preg_match('/^http/', $food_obj->image_1))
					{
						$renamed_image_1 = $food_obj->image_1;	
					}
 					else
					{
						$renamed_image_1 = Model_Food::rename_image($food_obj->image_1, $food_obj->shop_id, $food_obj->id);
					}

					if (Model_Food::update_image($food_obj->id, $renamed_image_1))
					{
						$db->commit_transaction();
						Session::set_flash('success', '料理の更新に成功しました #' . $food_obj->id . '.');
						Response::redirect('home');
					}
					else
					{
						throw new Exception('画像のリネームに失敗しました。');
					}
				}
				else
				{
					$food_obj->name = $val->validated('name');
					$food_obj->shop_id = $val->validated('shop_id');
					$food_obj->price = $val->validated('price');
					$food_obj->image_1 = $val->validated('image_1');
					$food_obj->cat1 = $val->validated('cat1');
					$food_obj->cat2 = $val->validated('cat2');
					$food_obj->cat3 = $val->validated('cat3');
					$food_obj->tag1 = $val->validated('tag1');
					$food_obj->tag2 = $val->validated('tag2');
					$food_obj->tag3 = $val->validated('tag3');
					$food_obj->tag4 = $val->validated('tag4');
					$food_obj->tag5 = $val->validated('tag5');

					throw new Exception($val->error());
				}
			}
			catch (Exception $ex)
			{
				Session::set_flash('error', $ex->getMessage());
				$db->rollback_transaction();
			}
		}
		$data['food'] = $food_obj;
		$this->template->title = "料理編集";
		$this->template->content = View::forge('food/edit', $data);
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
