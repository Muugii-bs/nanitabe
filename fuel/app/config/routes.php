<?php
return array(
	'_root_'  => 'home',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	'test' => 'socket/index',
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
