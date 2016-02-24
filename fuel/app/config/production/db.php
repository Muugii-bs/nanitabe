<?php
/**
 * The production database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'hostname'	=> 'localhost',
			'port'		=> '3306',
			'database'	=> 'nanitabe',
			'username'	=> 'baavgai',
			'password'	=> 'nanitabe',
		),
	),
	'profiling' => true,
);
