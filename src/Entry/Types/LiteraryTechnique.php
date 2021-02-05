<?php

namespace Benlumia007\Alembic\Entry\Types;

use Benlumia007\Alembic\Controllers\LiteraryTaxonomy as LiteraryTechniqueController;
use Benlumia007\Alembic\Controllers\Collection as CollectionController;
use Benlumia007\Alembic\Routing\Routes;
use Benlumia007\Alembic\App;

class LiteraryTechnique extends Type {

	public function name() {

		return 'literary_technique';
	}

	public function path() {

		return '_literary-techniques';
	}

	public function routes() {

		$this->router->get( 'writing/techniques/{name}', LiteraryTechniqueController::class );

		$this->router->get( 'writing/techniques', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/writing/techniques';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
