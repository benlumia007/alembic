<?php
/**
 * Page Controller.
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
 * Page Controller
 * 
 * @since  1.0.0
 * @access public
 */
class Page {

	protected $slug;
	protected $path;
	protected $params = [];

	public function __invoke( array $params = [] ) {

		$this->params = (array) $params;

		$_path = $this->params['name'];

		$page = explode( '/', $_path );
		$this->slug = urldecode( array_pop( $page ) );

		if ( '_' === substr( $this->slug, 0, 1 ) ) {
			$controller = new Error404();
			$controller();
			die();
		}

		$this->path = trim( str_replace( $this->slug, '', $_path ), '/' );

		$entries = $this->entries();

		$all = $entries->all();
		$entry = array_shift( $all );

		Engine::view( 'page', [ $this->slug ], [
			'title'   => $entry ? $entry->title() : 'Not Found',
			'query'   => $entry ? $entry : false,
			'page'    => 1,
			'entries' => $entries
		] )->display();
	}

	protected function entries() {

		$entries = [];

		// Because this is a page, let's assume the slug is a folder
		// name and check for `index.php` first.
		//
		// @todo - strip everything to first dot for ordered pages.
		$index_path = $this->path ? "{$this->path}/{$this->slug}" : $this->slug;

		$locator = new Locator( $index_path );

		$entries = new Entries( $locator, [ 'slug' => '_index' ] );

		if ( ! $entries->all() ) {

			$locator = new Locator( $this->path );

			$entries = new Entries( $locator, [ 'slug' => $this->slug ] );
		}

		return $entries;
	}
}