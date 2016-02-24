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
	}

}
