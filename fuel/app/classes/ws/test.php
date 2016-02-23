<?php
/**
 *
 * @author     Mugi
 * @copyright  Team Baavgai @Recruit-winter-intern
 */

class Ws_Test extends Ratchet_Ws
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
		/*
		if ( ! $conn->session instanceof Session_Driver)
		{
			return;
		}
		*/
		Log::debug('********** '.__FUNCTION__.' begin **********');
		Log::debug('before members : '.print_r(static::$members, true));
		Log::debug('join resourceId : '.$conn->resourceId);
		Log::debug('join name : '.$conn->session->get('ws.test.username'));
		static::$members[$conn->resourceId] = $conn->session->get('ws.test.username');
		Log::debug('after members : '.print_r(static::$members, true));
		Log::debug('********** '.__FUNCTION__.' end **********');

		$test = array(
			'test' => 'Open',
			'error' => 'none',
		);
		$conn->send(json_encode($test));
		$this->clients->attach($conn);
	}

	public function onClose(\Ratchet\ConnectionInterface $conn) {
		parent::onClose($conn);
		/*
		if ( ! $conn->session instanceof Session_Driver)
		{
			return;
		}
		*/
		Log::debug('********** '.__FUNCTION__.' begin **********');
		Log::debug('before members : '.print_r(static::$members, true));
		Log::debug('join resourceId : '.$conn->resourceId);
		Log::debug('join name : '.$conn->session->get('ws.test.username'));
		static::$members[$conn->resourceId] = $conn->session->get('ws.test.username');
		Log::debug('after members : '.print_r(static::$members, true));
		Log::debug('********** '.__FUNCTION__.' end **********');
		
		$test = array(
			'test' => 'Close',
			'error' => 'none',
		);
		$conn->send(json_encode($test));
		$this->clients->detach($conn);
	}	

	public function onError(\Ratchet\ConnectionInterface $conn, \Exception $e) {
		parent::onError($conn, $e);
		$conn->close();
	}

	public function onMessage(\Ratchet\ConnectionInterface $from, $json) {
		parent::onMessage($from, $json);
		$from->send($json);
		/*
		if ( ! $from->session instanceof Session_Driver)
		{
			return;
		}
		$json = json_decode($json);
		switch ($json->type)
		{
			case 'msg':
				if ( ! $this->validation->run(array('msg' => $json->msg)))
				{
					$array = array(
						'type' => 'error',
						'errors' => (array) $this->validation->error(),
					);
					$from->send(json_encode(Security::htmlentities($array)));
					return;
				}
			break;
		}
		 */
	}	
}
