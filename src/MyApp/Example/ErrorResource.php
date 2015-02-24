<?php

namespace MyApp\Example;

use Fliglio\Flfc\Request;
use Fliglio\Flfc\Response;

use Fliglio\Flfc\DefaultView;

class ErrorResource {

	public function __construct() {
	}
	
	public function handleError(Request $req, Response $resp) {
		$resp->setStatus(500);
		$resp->addHeader('Content-Type', 'text/json');
		return new DefaultView(json_encode(array(
			'exception' => $req->getProp('exception')
		)));
	}
	public function handlePageNotFound(Response $resp) {
		$resp->setStatus(404);
		$resp->addHeader('Content-Type', 'text/json');
		return new DefaultView(json_encode("Page Not Found"));
	}
	
}