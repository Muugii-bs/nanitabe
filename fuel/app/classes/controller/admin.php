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

/**
 * The Admin Controller.
 *
 * @package  app
 * @extends  Controller_Base
 */
class Controller_Admin extends Controller_Base
{
	public $template = 'template_login';

	public function action_login()
	{
        //すでにログイン済であればログイン後のページへリダイレクト
        Auth::check() and Response::redirect('/');

        //ログイン用のオブジェクト生成
        $auth = Auth::instance();

        //ログインボタンが押されたら、ユーザ名、パスワードをチェックする
        if (Input::post())
		{
            if ($auth->login(Input::post('username'), Input::post('password'))) 
			{
                // ログイン成功時、ログイン後のページへリダイレクト
                Response::redirect('/');
            }
			else
			{
                // ログイン失敗時、エラーメッセージ作成
				Session::set_flash('error', 'ユーザ名かパスワードに誤りがあります');
            }
        }

        //ビューテンプレートを呼び出し
        $data = array();
        $this->template->title = 'login';
        $this->template->content = View::forge('admin/login', $data);

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
				// ショップの初期化
				$shop_obj = Model_Shop::init(Input::post('shop.name'));
				if (empty($shop_obj))
				{
					throw new Exception('お店の保存に問題が発生しました。');
				}

				$val = Model_Admin::validate('create');

				if ($val->run())
				{
					$admin_id = Auth::create_user(
            			Input::post('username'),
            			Input::post('password'),
            			Input::post('email')
        			);
					$admin = Model_Admin::find($admin_id);
					$admin->shop_id = $shop_obj->id;

					if ($admin and $admin->save())
					{
						$db->commit_transaction();
						Session::set_flash('success', '管理者の保存に成功しました #'.$admin->id.'.');
						Response::redirect('/');
					}
					else
					{
						throw new Exception('管理者の保存に問題が発生しました。');
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

		$this->template->title = "Users";
		$this->template->content = View::forge('admin/create');
	}
	
    public function action_logout()
	{
		$auth = Auth::instance();
		$auth->logout();
		
		Response::redirect('/');
    }

}
