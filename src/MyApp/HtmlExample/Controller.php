<?php

namespace MyApp\HtmlExample;

use Fliglio\Http\ResponseWriter;
use Fliglio\Routing\Routable;
use Fliglio\Routing\Input\RouteParam;
use Fliglio\Routing\Input\GetParam;

use Fliglio\Flfc\DefaultView;

class Controller {

	public function __construct() {
	}
	
	public function index(ResponseWriter $resp) {
		return new DefaultView('
			<h1>Fliglio</h1>
			<p>Say Hello</p>
			<ul>
				<li><a href="/world">to world</a></li>
				<li><a href="/galaxy">to the galaxy</a></li>
				<li><a href="/universe">to the universe</a></li>
			</ul>
			<p>And more specifically...</p>
			<ul>
				<li><a href="/world?name=Earth">to the Earth</a></li>
				<li><a href="/galaxy?name=Milky%20Way">to the Milky Way</a></li>
				<li><a href="/universe?name=*">to the universe</a></li>
			</ul>
		');
	}

	public function topic(RouteParam $topic, GetParam $name = null) {
		if (!is_null($name) && $name->get() == 'oops') {
			throw new \Exception('Oops!');
		}
		return new DefaultView(sprintf(
			"<h3>Hello %s</h3>",
			$name == null ? $topic->get() : $name->get()
		));
	}
	
}