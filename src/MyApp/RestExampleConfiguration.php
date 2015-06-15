<?php

namespace MyApp;

use Fliglio\Http\Http;
use Fliglio\Routing\Type\RouteBuilder;
use Fliglio\Fli\DefaultConfiguration;
use MyApp\RestExample\FooResource;

class RestExampleConfiguration extends DefaultConfiguration {

	public function getRoutes() {
		$resource = new FooResource();
		return [
			RouteBuilder::get()
				->uri('/api/foo/:id')
				->resource($resource, 'getFoo')
				->method(Http::METHOD_GET)
				->build(),
			RouteBuilder::get()
				->uri('/api/foo')
				->resource($resource, 'addFoo')
				->method(Http::METHOD_POST)
				->build(),
			RouteBuilder::get()
				->uri('/api/foo')
				->resource($resource, 'getAllFoos')
				->method(Http::METHOD_GET)
				->build(),
		];
	}
}


