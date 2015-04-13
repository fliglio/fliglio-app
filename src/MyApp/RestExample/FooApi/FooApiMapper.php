<?php

namespace MyApp\RestExample\FooApi;

use Fliglio\Web\ApiMapper;


class FooApiMapper implements ApiMapper {

	public function marshalCollection(array $fooEntities) {
		$coll = array();
		foreach($fooEntities as $fooEntity) {
			$coll[] = $this->marshal($fooEntity);
		}
		return $coll;
	}
	public function marshal($fooEntity) {
		return array(
			'id' => $fooEntity->id,
			'type' => $fooEntity->type
		);
	}

	public function unmarshal($fooArray) {
		$f = new FooApi();
		if (isset($fooArray['id'])) {
			$f->id = $fooArray['id'];
		}
		$f->type = $fooArray['type'];
		return $f;
	}
}