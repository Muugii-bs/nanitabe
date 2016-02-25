<?php

class Util_Common
{
	public static function pref($id = null)
	{
		$a = array(1=>'北海道',2=>'青森県',3=>'岩手県',4=>'宮城県',5=>'秋田県',6=>'山形県',7=>'福島県',8=>'茨城県',9=>'栃木県',10=>'群馬県',11=>'埼玉県',12=>'千葉県',13=>'東京都',14=>'神奈川県',15=>'新潟県',16=>'富山県',17=>'石川県',18=>'福井県',19=>'山梨県',20=>'長野県',21=>'岐阜県',22=>'静岡県',23=>'愛知県',24=>'三重県',25=>'滋賀県',26=>'京都府',27=>'大阪府',28=>'兵庫県',29=>'奈良県',30=>'和歌山県',31=>'鳥取県',32=>'島根県',33=>'岡山県',34=>'広島県',35=>'山口県',36=>'徳島県',37=>'香川県',38=>'愛媛県',39=>'高知県',40=>'福岡県',41=>'佐賀県',42=>'長崎県',43=>'熊本県',44=>'大分県',45=>'宮崎県',46=>'鹿児島県',47=>'沖縄県');
		return is_null($id) ? $a : $a[$id];
	}

	public static function bread_crumbs() {
		//urlセグメントを全て配列で取得
        $urls = Uri::segments();

		$crumbs = '';
		$crumbs .= '<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>';
		if (!empty($urls[0])) {
			$crumbs .= '<li><a href="/'.$urls[0] . '">'.$urls[0].'</a></li>';
		}
		if (!empty($urls[1])) {
			$crumbs .= '<li class="active">'.$urls[1].'</li>';
		}
		return '<ol class="breadcrumb">' . $crumbs . '</ol>';
	}

	public static function food_cat1($id = null) {
		$a = array(
			0 => '大カテゴリを選択してください。',
			1=>'和食', 2=>'アジア・エスニック', 3=>'洋食', 4=>'肉料理',
			5=>'鍋料理', 6=>'居酒屋・バー', 7=>'カフェ', 8=>'その他'
		);
		return is_null($id) ? $a : $a[$id];
	}

	public static function food_cat2($id = null) {
		$a = array(
			0 => '中カテゴリを選択してください。',
			1 => 'すし・魚料理', 2=>'和食', 3=>'ラーメン・麺類',
			4=>'お好み焼・粉物', 5 => 'アジア・エスニック', 6=>'中華',
			7 => 'イタリアン', 8=>'洋食・西洋料理', 9=>'フレンチ',
			10=>'アメリカ料理', 11=>'アフリカ料理',
			12 => '焼肉・ステーキ', 13=>'焼鳥・串料理',
			14 => '鍋', 15=>'しゃぶしゃぶ・すき焼き',
			16 => '居酒屋・バー',
			17 => 'カフェ', 18=>'スイーツ',
			19 => 'その他',
		);
		return is_null($id) ? $a : $a[$id];
	}

	public static function food_cat3($id = null) {
		$a = array(
			0 => '小カテゴリを選択してください。',
			1 => '寿司', 2=>'魚介・海鮮料理', 3=>'回転寿司',
			4=>'海鮮丼', 5 => 'かに料理', 6=>'ふぐ料理',
			7 => 'すっぽん料理', 8=>'オイスターバー', 9=>'親子丼',
			10=>'牛丼', 11=>'天丼',
			12 => 'カツ丼', 13=>'おでん',
			14 => '定食', 15=>'和食のご飯・おかず',
			16 => 'とんかつ',
			17 => 'からあげ', 18=>'天ぷら',
			19 => 'その他',
		);
		return is_null($id) ? $a : $a[$id];
	}


	public static function save_log($result = array())
	{
		$log['body'] = json_encode($result);
		$log_obj = Model_Log::forge($log);
		if ( ! $log_obj->save())
		{
			return false;	
		}
		
		// yes と no の値を更新
		$yes_list = $result['body']['yes'];
		if ( ! Util_Common::update_foods_yes($yes_list))
		{
			return false;
		}
		
		$no_list = $result['body']['yes'];
		if ( ! Util_Common::update_foods_yes($no_list))
		{
			return false;
		}
		
		return true;
	}

	public static function update_foods_yes($yes_list = array())
	{
		if (empty($yes_list))
		{
			return false;
		}
		foreach ($yes_list as $food)
		{
			// ここにElasticSearchのdeleteの部分を入れる
			\Helper_Wa::delete_document($food['id']);
			$food_obj = Model_Food::find($food['id']);	
			$food_obj->yes = $food_obj->yes + 1;
			if ( ! $food_obj->save())
			{
				// ここにElasticSearchの挿入の部分を入れる
				return false;
			}
			// ここにElasticSearchの挿入の部分を入れる
			\Helper_Wa::import_document($food['id']);
		}
		return true;
	}
}