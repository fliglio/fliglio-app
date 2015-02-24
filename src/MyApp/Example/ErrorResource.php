<?php

namespace MyApp\Example;

use Fliglio\Flfc\Request;
use Fliglio\Flfc\Response;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class ErrorResource {

	public function __construct() {
	}
	
	public function handleError(Request $req, Response $resp) {
		$resp->setStatus(500);
		return new JsonView(array(
			'exception' => $req->getProp('exception')
		));
	}
	public function handlePageNotFound(Response $resp) {
		$resp->setStatus(404);
		return new JsonView("Page Not Found");
	}
	
}