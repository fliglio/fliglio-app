<?php

namespace Fliglio\ApiDoc;

use Fliglio\Routing\Type\Route;
use Fliglio\Routing\Type\PatternRoute;
use Fliglio\Routing\Type\StaticRoute;
use Fliglio\Web\PathParam;

class RouteDocumenter {
	
	private $routes = array();
	private $resources = array();


	public function addRoutes(array $routes) {
		$this->routes = array_merge($this->routes, $routes);
		foreach ($routes as $route) {
			$this->parseRoute($route);
		}
	}
	public function getPaths() {
		return $this->resources;
	}

	public function debug() {
		print_r($this->resources);
	}

	private function parseRoute(Route $route) {
		$inst = $route->getResourceInstance();
		$meth = $route->getResourceMethod();

		$cl = new \ReflectionClass($inst);
		$clName = $cl->getName();

		if (!isset($this->resources[$clName])) {
			$this->resources[$clName] = [];
		}

		$vo = $this->parsePath($route, $inst, $meth);
		$this->resources[$clName][] = $vo;
	}

	private function parsePath(Route $route, $inst, $meth) {
		$path = $this->parsePathUri($route);
		$method = $route->getMethods()[0];

		$vo = [
			"path" => $path,
			"method" => $method,
			"name" => $meth,
			"path-params" => [],
		];

		foreach ($params as $p) {
		$m = new \ReflectionMethod($inst, $meth);
		$params = $m->getParameters();

			$c = new \ReflectionClass($p->getClass()->getName());
			
			$pParam = "Fliglio\Web\PathParam";
			if ($c->isSubclassOf($pParam) || $c->getName() == $pParam) {
				$vo["path-params"][] = [
					"name" => $p->getName(),
					"type" => $p->getClass()->getName(),
				];
			}
		}
		return $vo;
	}
	
	private function parsePathUri(Route $route) {
		$url = "";
		if ($route instanceof PatternRoute) {
			$url = $route->getPattern();
		} else if ($route instanceof StaticRoute) {
			$url = $route->getCriteria();
		}
		return $url;
	}

}
