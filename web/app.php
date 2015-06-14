<?php
namespace MyApp;



use Doctrine\Common\Annotations\AnnotationRegistry;

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors" , 1);

require_once __DIR__ . '/../vendor/autoload.php';

error_log(dirname(__DIR__) . "/vendor/symfony/validator");
AnnotationRegistry::registerAutoloadNamespace(
	'Symfony\\Component\\Validator\\Constraints\\',
	dirname(__DIR__) . "/vendor/symfony/validator"
);



$svc = new RestExampleService();
$svc->run();

