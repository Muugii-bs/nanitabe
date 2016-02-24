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
		$status = array(
			'action' => 'Open',
			'error' => 'none',
		);
		$conn->send(json_encode($status)); 
	}

	public function onClose(\Ratchet\ConnectionInterface $conn) {
		parent::onClose($conn);
		$status = array(
			'action' => 'Close',
			'error' => 'none',
		);
		$conn->send(json_encode($status));
		$conn->close();
		$this->clients->detach($conn);
		\Helper_Wa::save_log(static::$members[$conn->resourceId]);
		unset(static::$members[$conn->resourceId]);
		/*
		Log::debug('********** '.__FUNCTION__.' begin **********');
		Log::debug('before members : '.print_r($this->clients, true));
		Log::debug('join resourceId : '.$conn->resourceId);
		Log::debug('after members : '.print_r($this->clients, true));
		Log::debug('********** '.__FUNCTION__.' end **********');
		 */
	}	

	public function onError(\Ratchet\ConnectionInterface $conn, \Exception $e) {
		parent::onError($conn, $e);
		$conn->close();
	}

	public function onMessage(\Ratchet\ConnectionInterface $client, $msg) {
		parent::onMessage($client, $msg);
		$request = json_decode($msg, true);
		$res = array(
			"init" => "",
			"body" => array(),
			"error" => ""
		);
		switch ($request["type"]) {
			case "init":
				$res["type"] = "init";
				if(isset($request["body"]) && $request["body"]) {
					$res["body"] = \Helper_Wa::get_initial($request["body"]);	
					$res["error"] = "";
					$client->send($res);
				}
				else {
					$res["error"] = "Null body error!";
					$res["body"] = [];
					$client->send(json_encode($res));
				}
			case "request":
				$res["type"] = "request";
				if(isset($request["body"]) && $request["body"]) {
					static::$members[$client->resourceId] = $request["body"];
					$res["body"] = \Helper_Wa::get_response(static::$members[$client->resourceId], $request["body"]);
					$res["error"] = "";
					$client->send($res);
				}
				else {
					$res["error"] = "Null request error!";
					$res["body"] = [];
					$client->send(json_encode($res));
				}
			case "end":
				$res["type"] = "end";
				$client->send(json_encode($res));
				$conn->close();
				$this->clients->detach($conn);
				\Helper_Wa::save_log(static::$members[$conn->resourceId]);
				unset(static::$members[$conn->resourceId]);
	
			default:
				$res["type"] = "";
				$res["error"] = "Non type error!";
				$client->send(json_encode($res));
		}
	}	
}
