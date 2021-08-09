<?php

namespace Benlumia007\Alembic\Template\Engine;
use Benlumia007\Alembic\Template\View\Component as View;

class Component {

	public function view( $name, array $slugs = [], $data = [] ) {

		return new View( $name, $slugs, $data );
	}
}
