<?php
/**
 * Application class.
 *
 * This class is essentially a wrapper around the `Container` class that's
 * specific to the framework. This class is meant to be used as the single,
 * one-true instance of the framework. It's used to load up service providers
 * that interact with the container.
 *
 * @package   Benlumia007\Alembic
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright 2021. Benjamin Lu
 * @link      https://github.com/benlumia007/benjlu
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Benlumia007\Alembic\Core;

use Benlumia007\Alembic\Container\Container;
use Benlumia007\Alembic\Contracts\Core\Framework as FrameworkContract;
use Benlumia007\Alembic\Contracts\Bootable;
use Benlumia007\Alembic\Proxies\Proxy;
use Benlumia007\Alembic\Proxies\App;
use Benlumia007\Alembic\Routing\Provider as RoutesServiceProvider;
use Benlumia007\Alembic\Http\Provider as RequestServiceProvider;
use Benlumia007\Alembic\Template\View\Provider as ViewServiceProvider;
use Benlumia007\Alembic\Config\Provider as FileServiceProvider;
use Benlumia007\Alembic\Entry\Provider as ContentTypesServiceProvider;
use Benlumia007\Alembic\Cache\Provider as CacheServiceProvider;
use Benlumia007\Alembic\Misc\Provider as MiscServiceProvider;
/**
 * Application class.
 *
 * @since  1.0.0
 * @access public
 */
class Framework extends Container implements FrameworkContract, Bootable {

	/**
	 * The current version of the framework.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	const VERSION = '1.0.0';

	/**
	 * Array of service provider objects.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $providers = [];

	/**
	 * Array of static proxy classes and aliases.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $proxies = [];

	/**
	 * Registers the default bindings, providers, and proxies for the
	 * framework.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		$this->registerDefaultBindings();
		$this->registerDefaultProviders();
		$this->registerDefaultProxies();
	}

	/**
	 * Calls the functions to register and boot providers and proxies.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		$this->registerProviders();
		$this->bootProviders();
		$this->registerProxies();
	}

	/**
	 * Registers the default bindings we need to run the framework.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function registerDefaultBindings() {

		// Add the instance of this application.
		$this->instance( 'app', $this );

		// Add the version for the framework.
		$this->instance( 'version', static::VERSION );
	}

	protected function registerDefaultProviders() {
		array_map( function( $provider ) {
			$this->provider( $provider );
		}, [
			RequestServiceProvider::class,
            RoutesServiceProvider::class,
			ViewServiceProvider::class,
			FileServiceProvider::class,
			ContentTypesServiceProvider::class,
			CacheServiceProvider::class,
			MiscServiceProvider::class,
		] );
	}

	/**
	 * Adds the default static proxy classes.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function registerDefaultProxies() {

		$this->proxy( App::class, '\Benlumia007\Alembic\App' );
	}

	/**
	 * Adds a service provider.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string|object  $provider
	 * @return void
	 */
	public function provider( $provider ) {

		if ( is_string( $provider ) ) {
			$provider = $this->resolveProvider( $provider );
		}

		$this->providers[] = $provider;
	}

	/**
	 * Creates a new instance of a service provider class.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  string    $provider
	 * @return object
	 */
	protected function resolveProvider( $provider ) {

		return new $provider( $this );
	}

	/**
	 * Calls a service provider's `register()` method if it exists.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  string    $provider
	 * @return void
	 */
	protected function registerProvider( $provider ) {

		if ( method_exists( $provider, 'register' ) ) {
			$provider->register();
		}
	}

	/**
	 * Calls a service provider's `boot()` method if it exists.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  string    $provider
	 * @return void
	 */
	protected function bootProvider( $provider ) {

		if ( method_exists( $provider, 'boot' ) ) {
			$provider->boot();
		}
	}

	/**
	 * Returns an array of service providers.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return array
	 */
	protected function getProviders() {

		return $this->providers;
	}

	/**
	 * Calls the `register()` method of all the available service providers.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function registerProviders() {

		foreach ( $this->getProviders() as $provider ) {
			$this->registerProvider( $provider );
		}
	}

	/**
	 * Calls the `boot()` method of all the registered service providers.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function bootProviders() {

		foreach ( $this->getProviders() as $provider ) {
			$this->bootProvider( $provider );
		}
	}

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
	public function proxy( $class_name, $alias ) {

		$this->proxies[ $class_name ] = $alias;
	}

	/**
	 * Registers the static proxy classes.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function registerProxies() {

		Proxy::setContainer( $this );

		foreach ( $this->proxies as $class => $alias ) {
			class_alias( $class, $alias );
		}
	}
}
