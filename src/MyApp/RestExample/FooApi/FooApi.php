<?php

namespace MyApp\RestExample\FooApi;

use Fliglio\Web\ObjectValidationTrait;
use Fliglio\Web\Validation;

class FooApi implements Validation {
	use ObjectValidationTrait;

	public $id;
	public $type;

	protected function getRules() {
		return array(
			'id' => 'integer',
			'type' => 'required|minlength[3]|alpha'
		);
	}

}