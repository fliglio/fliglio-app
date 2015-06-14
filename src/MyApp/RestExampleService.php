<?php

namespace MyApp;

use Fliglio\Fli\DefaultResolverApp;
use Fliglio\Fli\FliMux;

class RestExampleService extends FliMux {
	public function __construct() {
		parent::__construct();

		$fli = new DefaultResolverApp();
		$fli->configure(new RestExampleConfiguration());

		$this->addApp($fli);
	}

}
