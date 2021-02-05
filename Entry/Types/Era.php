<?php

namespace Benlumia007\Alembic\Entry\Types;

use Benlumia007\Alembic\Controllers\Era as EraController;
use Benlumia007\Alembic\Controllers\Collection as CollectionController;
use Benlumia007\Alembic\Routing\Routes;
use Benlumia007\Alembic\App;

class Era extends Type {

	public function name() {

		return 'era';
	}

	public function path() {

		return '_eras';
	}

	public function routes() {

		$this->router->get( 'eras/{name}', EraController::class );

	//	$this->router->get( 'eras', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/eras';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
