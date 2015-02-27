<?php

namespace MyApp\HtmlExample;

use Fliglio\Http\ResponseWriter;
use Fliglio\Http\Http;

use Fliglio\Flfc\DefaultBody;

class Errors {

	public function __construct() {
	}
	
	public function handleError(ResponseWriter $resp) {
		$resp->setStatus(Http::STATUS_INTERNAL_SERVER_ERROR);
		return new DefaultBody(sprintf(
			'<h3>Error</h3><pre>%s</pre>',
			$req->getProp('exception')
		));
	}
	public function handlePageNotFound(ResponseWriter $resp) {
		$resp->setStatus(Http::STATUS_NOT_FOUND);
		return new DefaultBody('<h3>Page Not Found</h3>');
	}
	
}