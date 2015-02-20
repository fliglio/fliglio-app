<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class ErrorResource implements Routable {

	private $context;

	public function __construct(Context $context) {
		$this->context = $context;
	}
	
	public function handleError() {
		return new View("ERROR");
	}
	public function pageNotFound() {
		return new View("404");
	}
	
}