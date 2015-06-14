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

use Fliglio\Fli\DefaultFli;
use Fliglio\Fli\FliMux;


use Doctrine\Common\Annotations\AnnotationRegistry;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors" , 1);

require_once __DIR__ . '/../vendor/autoload.php';

error_log(dirname(__DIR__) . "/vendor/symfony/validator");
AnnotationRegistry::registerAutoloadNamespace(
	'Symfony\\Component\\Validator\\Constraints\\',
	dirname(__DIR__) . "/vendor/symfony/validator"
);




$fli = new DefaultFli();
$fli->configure(new RestExampleConfiguration());

$mux = new FliMux();
$mux->addFli($fli);

$mux->run();

