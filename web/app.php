<?php
namespace MyApp;

use Fliglio\Flfc\Context;
use Fliglio\Flfc\RequestFactory;
use Fliglio\Flfc\Response;
use Fliglio\Flfc\FcChainRegistry;
use Fliglio\Flfc\FcDispatcherFactory;

use Fliglio\Flfc\Resolvers\NamespaceFcChainResolver;
use Fliglio\Flfc\Resolvers\DefaultFcChainResolver;
use Fliglio\Flfc\Apps\HttpApp;
use Fliglio\Flfc\Apps\RestApp;
use Fliglio\Flfc\Apps\ServeHtmlApp;

use Fliglio\Routing\UriLintApp;
use Fliglio\Routing\RoutingApp;
use Fliglio\Routing\RouteMap;
use Fliglio\Routing\Type\RouteBuilder;
use Fliglio\Routing\DiInvokerApp;
use Fliglio\Web\HttpAttributes;


error_reporting(E_ALL | E_STRICT);
ini_set("display_errors" , 1);

require_once __DIR__ . '/../vendor/autoload.php';


// Configure Routing
$routeMap = new RouteMap();
$routeMap
	->connect('foo', RouteBuilder::get()
		->uri('/api/foo/:id')
		->command('MyApp\Example.FooResource.getFoo')
		->method(HttpAttributes::METHOD_GET)
		->build()
	)
	->connect("all-foo", RouteBuilder::get()
		->uri('/api/foo')
		->command('MyApp\Example.FooResource.getAllFoos')
		->method(HttpAttributes::METHOD_GET)
		->build()
	)
	->connect("error", RouteBuilder::get()
		->catchNone()
		->command('MyApp\Example.ErrorResource.handleError')
		->build()
	)
	->connect("404", RouteBuilder::get()
		->command('MyApp\Example.ErrorResource.handlePageNotFound')
		->build()
	);




// Configure Front Controller Chains
$htmlChain = new HttpApp(new ServeHtmlApp(dirname(__FILE__) . '/index.html'));
$apiChain  = new HttpApp(new RestApp(new UriLintApp(new RoutingApp(new DiInvokerApp(), $routeMap))));

// Configure Resolvers
$chains = new FcChainRegistry();
$chains->addResolver(new DefaultFcChainResolver($apiChain));
$chains->addResolver(new NamespaceFcChainResolver($apiChain, 'api'));

// Dispatch Request
$dispatcherFactory = new FcDispatcherFactory();
$dispatcher = $dispatcherFactory->createDefault($chains);
$dispatcher->dispatch();
