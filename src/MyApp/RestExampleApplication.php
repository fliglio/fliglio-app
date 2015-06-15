<?php

namespace MyApp;

use Fliglio\Fli\DefaultResolverApp;
use Fliglio\Fli\ResolverAppMux;

class RestExampleApplication extends ResolverAppMux {
	public function __construct() {
		parent::__construct();

		$fli = new DefaultResolverApp();
		$fli->configure(new RestExampleConfiguration());

		$this->addApp($fli);
	}

}
