<?php

namespace MyApp\RestExample\FooApi;

use Fliglio\Routing\ApiMapper;


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
			'id' => $fooEntity->getId(),
			'type' => $fooEntity->getType()
		);
	}

	public function unmarshal($fooJson) {
		$fooArray = json_decode($fooJson, true);

		$f = new FooApi();
		if (isset($fooArray['id'])) {
			$f->setId($fooArray['id']);
		}
		$f->setType($fooArray['type']);
		return $f;
	}
}