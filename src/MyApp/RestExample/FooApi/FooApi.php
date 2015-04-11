<?php

namespace MyApp\RestExample\FooApi;


class FooApi {

	private $id;
	private $type;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
}