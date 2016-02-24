<?php
/**
 *
 * @author     Mugi
 * @copyright  Team Baavgai @Recruit-winter-intern
 */

class Ws_Server extends Ratchet_Ws
{
	private $validation = null;
	private static $members = array();

	public function __construct() {
		$this->clients = new \SplObjectStorage;
		$this->validation = Validation::forge('onMessage');
		$this->validation->add('msg')
			->add_rule('trim')
			->add_rule('required')
			->add_rule('max_length', 1000);
	}

	public function onOpen(\Ratchet\ConnectionInterface $conn) {
		parent::onOpen($conn);
		$this->clients->attach($conn);
		static::$members[] = array(
			$conn->resourceId => '');
		$test = array(
			'action' => 'Open',
			'error' => 'none',
		);
		$conn->send(json_encode($test)); 
	}

	public function onClose(\Ratchet\ConnectionInterface $conn) {
		parent::onClose($conn);
		$test = array(
			'action' => 'Close',
			'error' => 'none',
		);
		$conn->send(json_encode($test));
		$conn->close();
		$this->clients->detach($conn);
		unset(static::$members[$conn->resourceId]);
		Log::debug('********** '.__FUNCTION__.' begin **********');
		Log::debug('before members : '.print_r($this->clients, true));
		Log::debug('join resourceId : '.$conn->resourceId);
		Log::debug('after members : '.print_r($this->clients, true));
		Log::debug('********** '.__FUNCTION__.' end **********');
	}	

	public function onError(\Ratchet\ConnectionInterface $conn, \Exception $e) {
		parent::onError($conn, $e);
		$conn->close();
	}

	public function onMessage(\Ratchet\ConnectionInterface $client, $msg) {
		parent::onMessage($client, $msg);
		$request = json_decode($msg, true);
		switch ($request["type"]) {
			case "init":
				$client->send("initialized. Your id is " . $client->resourceId);
			case "request":
				static::$members[$client->resourceId] = $request["body"];
				$client->send(static::$members[$client->resourceId]);
		}
	}	
}
