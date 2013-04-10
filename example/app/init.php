<?php
namespace MyApp;

use Fliglio\Flfc as flfc;
use Fliglio\Flfc\DefaultFcChainResolver;
use Fliglio\Flfc\FcChainFactory;
use Fliglio\Flfc\FcChainRunner;
use Fliglio\Flfc\Context;
use Fliglio\Flfc\Request;
use Fliglio\Flfc\Response;
use Fliglio\Web\Uri;
use Fliglio\Web\HttpAttributes;
use Fliglio\Routing\RouteMap;
use Fliglio\Routing as routing;


error_reporting(E_ALL | E_STRICT);
ini_set("display_errors" , 1);


require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';
include 'Example/Services.php';


// Configure Web Package
$apacheIsHttps = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on';
$f5IsHttps     = isset($_SERVER['ROI_HTTPS_REQUEST']) && strtolower($_SERVER['ROI_HTTPS_REQUEST']) == 'on';

HttpAttributes::setProtocol($apacheIsHttps || $f5IsHttps);

HttpAttributes::setHttpHost(
	isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : (
		isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME'] : (
			isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (
				isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : (
					'localhost'
				)
			)
		)
	)
);

switch (isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : null) {
	case 'post' : 
		HttpAttributes::setMethod(HttpAttributes::METHOD_POST);
		break;
	case 'get' : 
		HttpAttributes::setMethod(HttpAttributes::METHOD_GET);
		break;
	case 'put' : 
		HttpAttributes::setMethod(HttpAttributes::METHOD_PUT);
		break;
	case 'delete' : 
		HttpAttributes::setMethod(HttpAttributes::METHOD_DELETE);
		break;
}



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



// Configure Context
$context = Context::get();

$context->getRequest()->setCurrentUrl(new Uri('/' . ltrim($_GET['fliglio_request'], '/')));
$context->getRequest()->setPageNotFoundUrl("@404");
$context->getRequest()->setErrorUrl("@error");

$context->getRequest()->setRawInputStream(file_get_contents('php://input'));
$context->getRequest()->setParams($_REQUEST);



// Configure Front Controller Chain & Default Resolver

$chain = new flfc\HttpApp(new routing\RoutingApp(new routing\RestInvokerApp()));
$resolver = new DefaultFcChainResolver($chain);
FcChainFactory::addResolver($resolver);


// Run App
$chainRunner = new FcChainRunner();
$chainRunner->dispatchRequest(Context::get());
