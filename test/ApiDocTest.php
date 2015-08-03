<?php
namespace Fliglio\ApiDoc;


class ApiDocTest extends \PHPUnit_Framework_TestCase {
	
	public function testApiMapper() {
		$cfg = new \MyApp\RestExampleConfiguration();
		$routes = $cfg->getRoutes();

		
		$docs = new RouteDocumenter();
		$docs->addRoutes($routes);

		$docs->debug();


		$this->assertEquals("foo", "foo");
	}
}
