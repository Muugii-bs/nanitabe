<?php

return array(
		'default' => array(
			'type'           => 'mysqli',
			'connection'     => array(
				'hostname'       => 'localhost',
				'port'           => '3306',
				'database'       => 'nanitabe',
				'username'       => 'baavgai',
				'password'       => 'nanitabe',
				'persistent'     => false,
				'compress'       => false,
				),
			'identifier'   => '`',
			'table_prefix'   => '',
			'charset'        => 'utf8',
			'enable_cache'   => true,
		));
