<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class Services implements Routable {

	private $context;

	public function __construct(Context $context) {
		$this->context = $context;
	}
	
	public function foo() {
		return new View("foo");
	}

	public function getBar() {
		return new View("bar");
	}
	
	public function baz() {
		return new JsonView(array("baz"));
	}
	
	public function hello() {
		$p = $this->context->getRequest()->getProp('routeParams');
		return new View("hello " . $p['target']);
	}

	public function handleError() {
		return new View("ERROR");
	}
	public function pageNotFound() {
		return new View("404");
	}
	
}