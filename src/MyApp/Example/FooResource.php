<?php

namespace MyApp\Example;

use Fliglio\Flfc\Response;
use Fliglio\Routing\Routable;
use Fliglio\Routing\Input\RouteParam;
use Fliglio\Routing\Input\GetParam;

use Fliglio\Fltk\View;

class FooResource {

	public function __construct() {
	}
	
	public function getFoo(Response $resp, RouteParam $id) {
		$resp->addHeader('Content-Type', 'text/json');
		return new View(json_encode(array(
			'id' => $id->get(),
			'type' => 'foo'
		)));
	}

	public function getAllFoos(Response $resp, GetParam $type = null) {
		$resp = array(
			array(
				'id' => 1
			), array(
				'id' => 2
			)
		);
		if ($type != null && $type->get() == "true") {
			$resp[0]['type'] = 'foo';
			$resp[1]['type'] = 'foo';
		}

		$resp->addHeader('Content-Type', 'text/json');
		return new View(json_encode($resp));
	}
	
}