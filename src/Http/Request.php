<?php
/**
 * Http Request.
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
namespace Benlumia007\Alembic\Http;
use Benlumia007\Alembic\Proxies\App;

/**
 * Http Request
 * 
 * @since  1.0.0
 * @access public
 */
class Request {
	public function uri() {
		$script_name = $_SERVER['SCRIPT_NAME'];
		$request_uri = $_SERVER['REQUEST_URI'];

		$basepath = implode( '/', array_slice( explode( '/', $script_name ), 0, -1 ) ) . '/';

		$uri = substr( $request_uri, strlen( $basepath ) );

		if ( strstr( $uri, '?' ) ) {
			$uri = substr( $uri, 0, strpos( $uri, '?' ) );
		}

		$uri = Benlumia007\Alembic\Tools\Str::slashBefore( $uri );

		$uri = preg_replace( '/[^A-Za-z0-9\/_-]/i', '', $uri );

		return $uri;
	}

	protected function maybeRedirect( $uri ) {

		$redirects = require_once( path( 'config/redirects.php' ) );

	//	var_dump( $redirects );

		if ( array_key_exists( $uri, $redirects['301'] ) ) {
			// Permanent 301 redirection
			header( "HTTP/1.1 301 Moved Permanently" );
			header( "Location: " . e( uri( $redirects['301'][ $uri ] ) ) . "" );
			exit();
		}
	}
}