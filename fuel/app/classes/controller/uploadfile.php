<?php

class Controller_Uploadfile extends \Controller_Hybrid
{
 
    public $template = null;
 
    public function action_index()
    {
        return new Response(View::forge('uploadfile', array()));
    }
 
    public function post_index()
    {
        // プロファイリング停止
        Fuel::$profiling = false;
 
        // アップロード設定
        $config = array(
            'path' => DOCROOT.'upload',
            'ext_whitelist' => array('jpg', 'jpeg', 'gif', 'png'),
        );
 
        // アップロード
        $json = array();
        \Upload::process($config);
        if ( \Upload::is_valid() )
        {
            \Upload::save();
            $json = \Upload::get_files(0);
        }
        else
        {
            $json['errors'] = \Upload::get_errors();
        }
         
        $this->response($json);
    }
}