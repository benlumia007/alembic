<?php

namespace Benlumia007\Alembic\Entry\Types;

use Benlumia007\Alembic\Controllers\Portfolio as PortfolioController;

class Portfolio extends Type {

	public function name() {

		return 'portfolio';
	}

	public function path() {

		return '_portfolio';
	}

	public function routes() {

		$this->router->get( 'portfolio/{name}', Controller::class );
		$this->router->get( 'portfolio', LiteratureArchive::class );
		$this->router->get( 'portfolio/page/{number}', LiteratureArchive::class, 'top' );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/portfolio';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}