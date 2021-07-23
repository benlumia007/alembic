<?php
/**
 * Framework contract.
 *
 * The Framework class should be the be the primary class for working with and
 * launching the app. It extends the `Container` contract.
 *
 * @package   Alembic
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright 2021. Benjamin Lu
 * @link      https://github.com/benlumia007/alembic-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Benlumia007\Alembic\Contracts\Core;

use Benlumia007\Alembic\Contracts\Container\Container;

/**
 * Framework interface.
 *
 * @since  1.0.0
 * @access public
 */
interface Framework extends Container {

	/**
	 * Adds a service provider. Developers can pass in an object or a fully-
	 * qualified class name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string|object  $provider
	 * @return void
	 */
	public function provider( $provider );

	/**
	 * Adds a static proxy alias. Developers must pass in fully-qualified
	 * class name and alias class name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $class_name
	 * @param  string  $alias
	 * @return void
	 */
	public function proxy( $class_name, $alias );
}
