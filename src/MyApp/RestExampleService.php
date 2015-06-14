<?php

namespace MyApp;

use Fliglio\Fli\DefaultFli;
use Fliglio\Fli\FliMux;

class RestExampleService extends FliMux {
	public function __construct() {
		parent::__construct();

		$fli = new DefaultFli();
		$fli->configure(new RestExampleConfiguration());

		$this->addFli($fli);
	}

}
