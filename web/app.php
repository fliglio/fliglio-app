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

use Fliglio\Routing\UrlLintApp;
use Fliglio\Routing\RoutingApp;
use Fliglio\Routing\RouteMap;
use Fliglio\Routing\Type\RouteBuilder;
use Fliglio\Routing\DefaultInvokerApp;
use Fliglio\Http\Http;

use Doctrine\Common\Annotations\AnnotationRegistry;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors" , 1);

require_once __DIR__ . '/../vendor/autoload.php';
error_log(dirname(__DIR__) . "/vendor/symfony/validator");
AnnotationRegistry::registerAutoloadNamespace(
	'Symfony\\Component\\Validator\\Constraints\\', 
	dirname(__DIR__) . "/vendor/symfony/validator"
);

// Configure Routing
$restRouteMap = new RouteMap();
$restRouteMap
	->connect('foo', RouteBuilder::get()
		->uri('/api/foo/:id')
		->command('MyApp\RestExample.FooResource.getFoo')
		->method(Http::METHOD_GET)
		->build()
	)
	->connect('add-foo', RouteBuilder::get()
		->uri('/api/foo')
		->command('MyApp\RestExample.FooResource.addFoo')
		->method(Http::METHOD_POST)
		->build()
	)
	->connect("all-foo", RouteBuilder::get()
		->uri('/api/foo')
		->command('MyApp\RestExample.FooResource.getAllFoos')
		->method(Http::METHOD_GET)
		->build()
	);

$htmlRouteMap = new RouteMap();
$htmlRouteMap
	->connect('home', RouteBuilder::get()
		->uri('/')
		->command('MyApp\HtmlExample.Controller.index')
		->method(Http::METHOD_GET)
		->build()
	)
	->connect("topic", RouteBuilder::get()
		->uri('/:topic')
		->command('MyApp\HtmlExample.Controller.topic')
		->method(Http::METHOD_GET)
		->build()
	)
	->connect("error", RouteBuilder::get()
		->command('MyApp\HtmlExample.Errors.handleError')
		->build()
	)
	->connect("404", RouteBuilder::get()
		->catchAll()
		->command('MyApp\HtmlExample.Errors.handlePageNotFound')
		->build()
	);




// Configure Front Controller Chains
$htmlChain  = new HttpApp(new UrlLintApp(new RoutingApp(new DefaultInvokerApp(), $htmlRouteMap)));
$apiChain  = new HttpApp(new RestApp(new UrlLintApp(new RoutingApp(new DefaultInvokerApp(), $restRouteMap))));

// Configure Resolvers
$chains = new FcChainRegistry();
$chains->addResolver(new DefaultFcChainResolver($htmlChain));
$chains->addResolver(new NamespaceFcChainResolver($apiChain, 'api'));

// Dispatch Request
$dispatcherFactory = new FcDispatcherFactory();
$dispatcher = $dispatcherFactory->createDefault($chains);
$dispatcher->dispatch();
