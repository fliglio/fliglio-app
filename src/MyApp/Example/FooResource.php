<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;
use Fliglio\RestFc\Input\RouteParam;
use Fliglio\RestFc\Input\GetParam;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class FooResource {

	public function __construct(Context $context) {
	}
	
	public function getFoo(Context $context, RouteParam $id) {
		return new JsonView(array(
			'id' => $id->get(),
			'type' => 'foo'
		));
	}

	public function getAllFoos(GetParam $type = null) {
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
		return new JsonView($resp);
	}
	
}