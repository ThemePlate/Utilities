<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

declare(strict_types=1);

namespace ThemePlate\Utilities;

abstract class HookHandler {

	private string $handle_with_method = '';

	private bool $run_only_once = false;


	public function with( string $method ): static {

		if ( method_exists( $this, $method ) ) {
			$clone = clone $this;

			$clone->handle_with_method = $method;

			return $clone;
		}

		return $this;

	}


	public function once(): static {

		$clone = clone $this;

		$clone->run_only_once = true;

		return $clone;

	}


	public function handle(): mixed {

		if ( $this->run_only_once ) {
			global $wp_filter;

			$id = _wp_filter_build_unique_id( '', array( $this, __FUNCTION__ ), 0 );

			$callbacks = array_map( 'array_keys', $wp_filter[ current_filter() ]->callbacks );

			foreach ( $callbacks as $priority => $registered ) {
				if ( in_array( $id, $registered, true ) ) {
					break;
				}
			}

			remove_filter( current_filter(), array( $this, __FUNCTION__ ), $priority ?? 10 );
		}

		if ( $this->handle_with_method ) {
			return call_user_func_array( array( $this, $this->handle_with_method ), func_get_args() );
		}

		return func_get_arg( 0 );

	}

}
