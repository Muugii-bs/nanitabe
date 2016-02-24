<?php

/*
 * @author Mugi
 * @action initialize Elasticsearch server
 **/

namespace Fuel\Tasks;

class esInitialize
{
	public function run() {
		\Helper_Wa::wa_initialize();
	}
}

