<?php

namespace MyApp\Example;

use Fliglio\Flfc\Context;
use Fliglio\Routing\Routable;

use Fliglio\Fltk\View;
use Fliglio\Fltk\JsonView;

class FooResource implements Routable {

	private $context;

	public function __construct(Context $context) {
		$this->context = $context;
	}
	
	public function getFoo() {
		$id = $this->context->getRequest()->getProp('routeParams')['id'];
		return new JsonView(array(
			'id' => $id,
			'type' => 'foo'
		));
	}

	public function getAllFoos() {
		return new JsonView(array(
			array(
				'id' => 1,
				'type' => 'foo'
			), array(
				'id' => 2,
				'type' => 'foo'
			)
		));
	}
	
}