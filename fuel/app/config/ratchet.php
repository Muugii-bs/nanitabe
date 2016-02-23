<?php

return array(
	'classes' => array(
		'default' => array(
//			'ws_uri' => 'ws://example.com/ws', // For Proxy.
			'domain' => 'example.com',
			'port' => '8001',
			'zmq_port' => '5555',
		),
		'Ratchet_Ws' => array(
//			'ws_uri' => 'ws://example.com/ws', // For Proxy.
			'domain' => 'example.com',
			'port' => '8001',
		),
		'Ratchet_Wamp' => array(
//			'ws_uri' => 'ws://example.com/ws', // For Proxy.
			'domain' => 'example.com',
			'port' => '8002',
			'zmq_port' => '5555',
		),
	),
);
