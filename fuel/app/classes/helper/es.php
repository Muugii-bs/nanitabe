<?php

class Helper_Es
{
	public static function get_client()
	{
		return new \Elastica\Client(array(
					'host' => '127.0.0.1',
					'port' => 9200
					));
	}

	public static function create_index($_index, $_type, $_mapping) {
		$index = \Helper_Es::get_client()->getIndex($_index);
		$index->create(array(), true);
		$type = $index->getType($_type);
		$mapping = new \Elastica\Type\Mapping($type, $_mapping);
		$type->setMapping($mapping);
	}

	public static function import_document($_index, $_type, $_id, $_doc) {
		$bulk = new \Elastica\Bulk(\Helper_Es::get_client());
		$index = \Helper_Es::get_client()->getIndex($_index);
		$type = $index->getType($_type);
		$bulk->setType($type);
		$doc = $type->createDocument($_id, $_doc);
		$bulk->addDocument($doc);
	  	$res = $bulk->send();
		if($res->isOk()) {
			return 'ok';
		} else {
			return $res->getError();
		}
	}	

	public static function execute_query($query, $path = "nanitabe/foods/_search") {
		$response = \Helper_Es::get_client()->request($path, \Elastica\Request::GET, $query);
		$responseArray = $response->getData();
		return $responseArray;
	}

}


