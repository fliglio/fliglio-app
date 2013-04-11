<?php

namespace Fliglio\App;


use Fliglio\Flfc\Context;
use Fliglio\Web\Uri;
use Fliglio\Web\HttpAttributes;

class Defaults {
	
	public static function initWebDefaults() {
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
	}
	
	public static function getContextDefault() {
		// Configure Context
		$context = Context::get();

		$context->getRequest()->setCurrentUrl(new Uri('/' . ltrim($_GET['fliglio_request'], '/')));
		$context->getRequest()->setPageNotFoundUrl("@404");
		$context->getRequest()->setErrorUrl("@error");

		$context->getRequest()->setRawInputStream(file_get_contents('php://input'));
		$context->getRequest()->setParams($_REQUEST);
		return $context
	}
}