<?php

namespace Benlumia007\Alembic\Entry\Types;

use Benlumia007\Alembic\Controllers\Taxonomy as TaxonomyController;
use Benlumia007\Alembic\Controllers\Collection as CollectionController;
use Benlumia007\Alembic\Routing\Routes;
use Benlumia007\Alembic\App;

class Taxonomy extends Type {

	public function name() {

		return 'category';
	}

	public function path() {

		return '_topics';
	}

	public function routes() {

		$this->router->get( 'topics/{name}', TaxonomyController::class );

	//	$this->router->get( 'topics', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/topics';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
