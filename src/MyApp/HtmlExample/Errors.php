<?php

namespace MyApp\HtmlExample;

use Fliglio\Http\ResponseWriter;

use Fliglio\Flfc\DefaultBody;

class Errors {

	public function __construct() {
	}
	
	public function handleError(ResponseWriter $resp) {
		$resp->setStatus(500);
		return new DefaultBody(sprintf(
			'<h3>Error</h3><pre>%s</pre>',
			$req->getProp('exception')
		));
	}
	public function handlePageNotFound(ResponseWriter $resp) {
		$resp->setStatus(404);
		return new DefaultBody('<h3>Page Not Found</h3>');
	}
	
}