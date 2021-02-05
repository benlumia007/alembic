<?php

namespace Benlumia007\Alembic\Entry\Types;

use Benlumia007\Alembic\Controllers\LiteraryTaxonomy as LiteraryFormController;
use Benlumia007\Alembic\Controllers\Collection as CollectionController;
use Benlumia007\Alembic\Routing\Routes;
use Benlumia007\Alembic\App;

class LiteraryForm extends Type {

	public function name() {

		return 'literary_form';
	}

	public function path() {

		return '_literary-forms';
	}

	public function routes() {

		$this->router->get( 'writing/forms/{name}', LiteraryFormController::class );

		$this->router->get( 'writing/forms', CollectionController::class );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/writing/forms';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}
