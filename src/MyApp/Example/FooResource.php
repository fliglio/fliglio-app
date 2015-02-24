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
		return array(
			'id' => $id->get(),
			'type' => 'foo'
		);
	}

	public function getAllFoos(Response $resp, GetParam $type = null) {
		$arr = array(
			array(
				'id' => 1
			), array(
				'id' => 2
			)
		);
		if ($type != null && $type->get() == "true") {
			$arr[0]['type'] = 'foo';
			$arr[1]['type'] = 'foo';
		}

		return $arr;
	}
	
}