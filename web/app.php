<?php
namespace MyApp;

use Fliglio\Flfc\Context;
use Fliglio\Flfc\Request;
use Fliglio\Flfc\Response;
use Fliglio\Flfc as flfc;
use Fliglio\Flfc\NamespaceFcChainResolver;
use Fliglio\Flfc\DefaultFcChainResolver;
use Fliglio\Flfc\FcChainFactory;
use Fliglio\Flfc\FcChainRunner;
use Fliglio\Routing\UriLintApp;
use Fliglio\Routing\RoutingApp;
use Fliglio\Routing\RouteMap;
use Fliglio\Routing\Type\RouteBuilder;
use Fliglio\Web\HttpAttributes;
use Fliglio\RestFc\DiInvokerApp;


require_once __DIR__ . '/../fliglio/bootstrap.php';



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
		->catchAll()
		->command('MyApp\Example.ErrorResource.handlePageNotFound')
		->build()
	);




// Configure Front Controller Chain & Default Resolver
$htmlChain = new flfc\HttpApp(new flfc\ServeHtmlApp(dirname(__FILE__) . '/index.html'));
$apiChain  = new flfc\HttpApp(new UriLintApp(new RoutingApp(new DiInvokerApp(), $routeMap)));

FcChainFactory::addResolver(new DefaultFcChainResolver($apiChain));
FcChainFactory::addResolver(new NamespaceFcChainResolver($apiChain, 'api'));

// Run App
$context = new Context(Request::createDefault(), new Response());
$chainRunner = new FcChainRunner();
$chainRunner->dispatchRequest($context, "@404", "@error");

