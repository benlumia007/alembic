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
use Benlumia007\Alembic\App;

/**
 * Post Controller
 */
class Post {
	protected $slug;
	protected $path = '_posts';
	protected $type;
	protected $params = [];

	public function __invoke( array $params = [] ) {
		$this->params = (array) $params;

        $this->slug = $this->params['name'];

        $this->type = App::resolve( 'content/types' )->get( 'post' );

		$entries = $this->entries();

        $all = $entries->all();

        $entry = array_shift( $all );

		Engine::view( 'single', [], [
			'title'   => $entry ? $entry->title() : 'Not Found',
			'query'   => $entry ? $entry : false,
			'page'    => 1,
			'entries' => $entries
		] )->display();
	}

	protected function entries() {

		$locator = new Locator( $this->type->path() );

		return new Entries( $locator, [ 'slug' => $this->slug ] );
	}
}