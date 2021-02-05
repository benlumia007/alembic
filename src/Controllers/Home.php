<?php
/**
 * Home Controller.
 *
 * @package   Alembic Core
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright 2021. Benjamin Lu
 * @link      https://github.com/benlumia007/benjlu
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Benlumia007\Alembic\Controllers;
use Benlumia007\Alembic\Entry\Entries;
use Benlumia007\Alembic\Entry\Locator;
use Benlumia007\Alembic\Engine;

/**
 * Home Controller
 * 
 * @since  1.0.0
 * @access public
 */
class Home {

	protected $params;

	public function __invoke( array $params = [] ) {

		$this->params = $params;

		Engine::view( 'home', [], [
			'page'    => isset( $this->params['number'] ) ? intval( $this->params['number'] ) : 1,
			'entries' => $this->entries(),
			'title'   => 'Benjamin Lu'
		] )->display();
	}

	protected function entries() {

		$path = '_posts';

		$locator = new Locator( $path );

		$per_page = posts_per_page();
		$current  = isset( $this->params['number'] ) ? intval( $this->params['number'] ) : 1;

		$args = [
			'number' => $per_page,
			'offset' => $per_page * ( $current - 1 ),
			'order'  => 'desc',
		//	'orderby' => 'date'
		];

		return new Entries( $locator, $args );
	}
}