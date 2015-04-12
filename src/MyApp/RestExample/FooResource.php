<?php

namespace MyApp\RestExample;

use Fliglio\Routing\Routable;
use Fliglio\Routing\Input\Body;
use Fliglio\Routing\Input\RouteParam;
use Fliglio\Routing\Input\GetParam;

use Fliglio\Fltk\View;

use MyApp\RestExample\FooApi\FooApi;
use MyApp\RestExample\FooApi\FooApiMapper;

use Fliglio\Http\ResponseWriter;
use Fliglio\Http\Http;

class FooResource {

	public function __construct() {
	}
	
	public function getFoo(RouteParam $id) {
		$f = new FooApi();
		$f->id = $id->get();
		$f->type = 'foo';
		return $f;
	}

	public function getAllFoos(GetParam $type = null) {
		$f = new FooApi();
		$f->id = 1;
		$f->type = 'foo';

		$f2 = new FooApi();
		$f2->id = 2;
		$f2->type = 'bar';

		if (!is_null($type)) {
			switch ($type->get()) {
			case 'foo':
				return array($f);
			case 'bar':
				return array($f2);
			default:
				return array();
			}
		}
		return array($f, $f2);
	}
	
	public function addFoo(Body $body, ResponseWriter $resp) {
		$foo = $body->bind(new FooApiMapper());

		// add foo...
		$foo->id = 321;

		$resp->setStatus(Http::STATUS_CREATED);
		return $foo;
	}

}