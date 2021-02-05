<?php

namespace Benlumia007\Alembic\Entry\Types;

use Benlumia007\Alembic\Controllers\Tag as TagController;
use Benlumia007\Alembic\Controllers\Collection as CollectionController;
use Benlumia007\Alembic\Routing\Routes;
use Benlumia007\Alembic\App;

class Tag extends Type {

	public function name() {

		return 'tag';
	}

	public function path() {

		return '_tags';
	}

	public function routes() {

		$this->router->get( 'tags/{name}', TagController::class );

		$this->router->get( 'tags', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/tags';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
