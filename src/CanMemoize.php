<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

declare(strict_types=1);

namespace ThemePlate\Utilities;

trait CanMemoize {

	protected static array $memoized = array();


	protected function memoize( string $method, array $args = array() ): mixed {

		if ( empty( self::$memoized[ $method ] ) ) {
			self::$memoized[ $method ] = array();
		}

		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_print_r
		$hash = md5( print_r( $args, true ) );

		if ( isset( self::$memoized[ $method ][ $hash ] ) ) {
			return self::$memoized[ $method ][ $hash ];
		}

		$value = call_user_func_array( array( $this, $method ), $args );

		self::$memoized[ $method ][ $hash ] = $value;

		return $value;

	}


	protected function unmemoize( string $method, array $args = array() ): void {

		if ( empty( self::$memoized[ $method ] ) ) {
			return;
		}

		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_print_r
		$hash = md5( print_r( $args, true ) );

		if ( isset( self::$memoized[ $method ][ $hash ] ) ) {
			unset( self::$memoized[ $method ][ $hash ] );
		}

	}

}
