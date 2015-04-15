<?php

namespace MyApp\RestExample\FooApi;

use Fliglio\Web\ObjectValidationTrait;
use Fliglio\Web\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class FooApi implements Validation {
	use ObjectValidationTrait;

    /**
     * @Assert\Type(type="integer")
     */
	public $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
	public $type;


}