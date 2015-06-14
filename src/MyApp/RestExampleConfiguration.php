<?php

namespace MyApp;

use Fliglio\Fli\DefaultConfiguration;

class RestExampleConfiguration extends DefaultConfiguration {

	public function getRoutes() {
		return [
			RouteBuilder::get()
				->uri('/api/foo/:id')
				->command('MyApp\RestExample.FooResource.getFoo')
				->method(Http::METHOD_GET)
				->build(),
			RouteBuilder::get()
				->uri('/api/foo')
				->command('MyApp\RestExample.FooResource.addFoo')
				->method(Http::METHOD_POST)
				->build(),
			RouteBuilder::get()
				->uri('/api/foo')
				->command('MyApp\RestExample.FooResource.getAllFoos')
				->method(Http::METHOD_GET)
				->build(),
		];
	}

//	public function getInjectables() {
//		return (new DefaultInjectablesFactory())->createAll();
//	}
}


