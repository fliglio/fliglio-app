<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class ErrorResource implements Routable {

	public function __construct() {
	}
	
	public function handleError() {
		return new View("ERROR");
	}
	public function pageNotFound() {
		return new View("404");
	}
	
}