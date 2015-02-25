<?php

namespace MyApp\HtmlExample;

use Fliglio\Http\ResponseWriter;

use Fliglio\Flfc\DefaultView;

class Errors {

	public function __construct() {
	}
	
	public function handleError(ResponseWriter $resp) {
		$resp->setStatus(500);
		return new DefaultView(sprintf(
			'<h3>Error</h3><pre>%s</pre>',
			$req->getProp('exception')
		));
	}
	public function handlePageNotFound(ResponseWriter $resp) {
		$resp->setStatus(404);
		return new DefaultView('<h3>Page Not Found</h3>');
	}
	
}