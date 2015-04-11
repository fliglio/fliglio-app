<?php

namespace MyApp\RestExample;

use Fliglio\Routing\Routable;
use Fliglio\Routing\Input\RouteParam;
use Fliglio\Routing\Input\GetParam;

use Fliglio\Fltk\View;

use MyApp\RestExample\FooApi\FooApi;
class FooResource {

	public function __construct() {
	}
	
	public function getFoo(RouteParam $id) {
		$f = new FooApi();
		$f->setId($id->get());
		$f->setType('foo');
		return $f;
	}

	public function getAllFoos(GetParam $type = null) {
		$f = new FooApi();
		$f->setId(1);
		$f->setType('foo');

		$f2 = new FooApi();
		$f2->setId(2);
		$f2->setType('bar');

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
	
	public function addFoo(FooApi $foo) {
		//add foo...
		$foo->setId(321);
		return $foo;
	}

}