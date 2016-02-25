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

	public function action_edit()
	{
		if ( ! $shop_obj = Model_Shop::find($this->current_admin['shop_id']))
		{
			Session::set_flash('error', 'お店レコードが見つかりません。 # ' . $id);
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
				$val = Model_Shop::validate('create');

				if ($val->run())
				{
					// 画像をまずはそのまま保存しあとでリネームする
					$shop_obj->name = Input::post('name');
					$shop_obj->zip = Input::post('zip');
					$shop_obj->address = Input::post('address');
					$shop_obj->longti = Input::post('longti');
					$shop_obj->lati = Input::post('lati');
					$shop_obj->url = Input::post('url');
					$shop_obj->tel = Input::post('tel');
					$shop_obj->image_1 = Input::post('image_1');
					$shop_obj->category = Input::post('category');

					if ( ! $shop_obj->save())
					{
						throw new Exception('お店の保存に問題が発生しました。');	
					}
					// ここで画像をリネーム（フォルダも作成）する
					if (preg_match('/^http/', $shop_obj->image_1))
					{
						$renamed_image_1 = $shop_obj->image_1;	
					}
 					else
					{
						$renamed_image_1 = Model_Shop::rename_image($shop_obj->image_1, $shop_obj->id);
					}

					if (Model_Shop::update_image($shop_obj->id, $renamed_image_1))
					{
						$db->commit_transaction();
						Session::set_flash('success', 'お店の更新に成功しました #' . $shop_obj->id . '.');
						Response::redirect('home');
					}
					else
					{
						throw new Exception('画像のリネームに失敗しました。');
					}
				}
				else
				{
					$shop_obj->name = $val->validated('name');
					$shop_obj->zip = $val->validated('zip');
					$shop_obj->address = $val->validated('address');
					$shop_obj->longti = $val->validated('longti');
					$shop_obj->lati = $val->validated('lati');
					$shop_obj->url = $val->validated('url');
					$shop_obj->tel = $val->validated('tel');
					$shop_obj->image_1 = $val->validated('image_1');

					throw new Exception($val->error());
				}
			}
			catch (Exception $ex)
			{
				Session::set_flash('error', $ex->getMessage());
				$db->rollback_transaction();
			}
		}
		$data['shop'] = $shop_obj;
		$this->template->title = "お店編集";
		$this->template->content = View::forge('shop/edit', $data);
	}
}
