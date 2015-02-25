<?php

namespace MyApp\RestExample;

use Fliglio\Routing\Routable;
use Fliglio\Routing\Input\RouteParam;
use Fliglio\Routing\Input\GetParam;

use Fliglio\Fltk\View;

class FooResource {

	public function __construct() {
	}
	
	public function getFoo(RouteParam $id) {
		return array(
			'id' => $id->get(),
			'type' => 'foo'
		);
	}

	public function getAllFoos(GetParam $type = null) {
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