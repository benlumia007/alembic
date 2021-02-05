<?php
/**
 * Container contract.
 *
 * Container classes should be used for storing, retrieving, and resolving
 * classes/objects passed into them.
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
namespace Benlumia007\Alembic\Contracts\Container;
use Colsure;

/**
 * Container interface
 * 
 * @since  1.0.0
 * @access public
 */
interface Container {
    /**
     * Binds an object.
     * 
     * @since  1.0.0
     * @access public
     * @param  string  $abstract
     * @param  mixed   $concrete
     * @param  bool    $shared
     * @return void
     */
    public function bind( $abstract, $concrete = null,  $shared = false );

    /**
     * Removes and object.
     * 
     * @since  1.0.0
     * @access public
     * @param  string  $abstract
     * @return void
     */
    public function remove( $abstract );

    /**
     * Resolves and Returns the definition.
     * 
     * @since  1.0.0
     * @access public
     * @param  string  $abstract
     * @param  array   $parameters
     * @return void
     */
    public function resolve( $abstract, $parameters = [] );

    /**
     * Alias for `resolve()`.
     * 
     * @since  1.0.0
     * @access public
     * @param  string  $abstract
     * @return object 
     */
    public function get( $abstract );

	/**
	 * Check if an object exists.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return bool
	 */
    public function has( $abstract );
    
	/**
	 * Add a shared object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  object  $concrete
	 * @return void
	 */
    public function singleton( $abstract, $concrete = null );
    
	/**
	 * Add an instance of an object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  mixed   $instance
	 * @return mixed
	 */
    public function instance( $abstract, $instance );

	 /**
	  * Extend a binding.
	  *
	  * @since  1.0.0
	  * @access public
	  * @param  string  $abstract
	  * @param  Closure $closure
	  * @return void
	  */
      public function extend( $abstract, Closure $closure );

      /**
       * Create an alias for an abstract type.
       *
       * @since  1.0.0
       * @access public
       * @param  string  $abstract
       * @param  string  $alias
       * @return void
       */
      public function alias( $abstract, $alias );
}