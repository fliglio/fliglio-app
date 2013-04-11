<?php
namespace MyApp;

use Fliglio\App\Defaults;
use Fliglio\Flfc as flfc;
use Fliglio\Flfc\DefaultFcChainResolver;
use Fliglio\Flfc\FcChainFactory;
use Fliglio\Flfc\FcChainRunner;
use Fliglio\Routing as routing;
use Fliglio\Routing\RouteMap;


error_reporting(E_ALL | E_STRICT);
ini_set("display_errors" , 1);


// require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
include 'Example/Services.php';

/* set up Fliglio\Web\HttpAttributes */
Defaults::initWebDefaults();

/* Fliglio\Flfc\Context */
$context = Defaults::getContextDefault();



// Configure Routing
RouteMap::setRoutes(array(
	"api" => new routing\PatternRoute('/api/:command', array(
		'ns'           => 'MyApp\Example',
		'commandGroup' => 'Services',
	)),
	"rest" => new routing\PatternRoute('/api/rest/:command', array(
		'ns'           => 'MyApp\Example',
		'commandGroup' => 'Services',
		'_restful'     => true,
	)),
	"baz" => new routing\StaticRoute('/api/static/baz', array(
		'cmd' => 'MyApp\Example.Services.baz',
	)),
	"hello" => new routing\PatternRoute('/api/hello/:target', array(
		'cmd' => 'MyApp\Example.Services.hello',
	)),
	"error" => new routing\CatchNoneRoute(array(
		'cmd' => 'MyApp\Example.Services.handleError',
	)),
	"404" => new routing\CatchAllRoute(array(
		'cmd' => 'MyApp\Example.Services.pageNotFound',
	)),
));






// Configure Front Controller Chain & Default Resolver

$chain = new flfc\HttpApp(new routing\RoutingApp(new routing\RestInvokerApp()));
$resolver = new DefaultFcChainResolver($chain);
FcChainFactory::addResolver($resolver);


// Run App
$chainRunner = new FcChainRunner();
$chainRunner->dispatchRequest($context);
