<?php

namespace Benlumia007\Alembic\Template\Engine;

class View {

	protected $name;
	protected $data;

	public function __construct( $name, array $slugs = [], $data = [] ) {

		$this->name = $name;
		$this->slugs = $slugs;
		$this->data = $data;
	}

	protected function locate() {

		foreach ( $this->slugs as $slug ) {

			if ( file_exists( path( "{$this->name}-{$slug}.php" ) ) ) {
				return path( "{$this->name}-{$slug}.php" );
			}
		}

		return path( "{$this->name}.php" );
	}

	public function display() {

		$data = $this->data;

		extract( $this->data );

		include( $this->locate() );
	}
}
