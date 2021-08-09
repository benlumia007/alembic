<?php
/**
 * Base service provider.
 *
 * This is the base service provider class. This is an abstract class that must
 * be extended to create new service providers for the Framework.
 *
 * @package   Benlumia007\AlembicCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2018, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Benlumia007\Alembic\Tools;

use Benlumia007\Alembic\Contracts\Core\Framework;

/**
 * Service provider class.
 *
 * @since  5.0.0
 * @access public
 */
abstract class ServiceProvider {

	/**
	 * Framework instance. Sub-classes should use this property to access
	 * the Framework (container) to add, remove, or resolve bindings.
	 *
	 * @since  5.0.0
	 * @access protected
	 * @var    Framework
	 */
	protected $app;

	/**
	 * Accepts the Framework and sets it to the `$app` property.
	 *
	 * @since  5.0.0
	 * @access public
	 * @param  Framework  $app
	 * @return void
	 */
	public function __construct( Framework $app ) {

		$this->app = $app;
	}

	/**
	 * Callback executed when the `Framework` class registers providers.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function register() {}

	/**
	 * Callback executed after all the service providers have been registered.
	 * This is particularly useful for single-instance container objects that
	 * only need to be loaded once per page and need to be resolved early.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {}
}
