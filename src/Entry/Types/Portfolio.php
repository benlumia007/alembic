<?php

namespace Benlumia007\Alembic\Entry\Types;

use Benlumia007\Alembic\Controllers\Portfolio as PortfolioController;
use Benlumia007\Alembic\Controllers\PortfolioArchive;

class Portfolio extends Type {

	public function name() {

		return 'portfolio';
	}

	public function path() {

		return '_portfolio';
	}

	public function routes() {

		$this->router->get( 'portfolio/{name}', Controller::class );
		$this->router->get( 'portfolio', PortfolioArchive::class );
		$this->router->get( 'portfolio/page/{number}', PortfolioArchive::class, 'top' );
	}

	public function uri( $path = '' ) {

		$uri = App::resolve( 'uri/relative' ) . '/portfolio';

		return $path ? "{$uri}/{$path}" : $uri;
	}




}