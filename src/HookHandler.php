<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

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
			remove_filter( current_filter(), array( $this, __FUNCTION__ ) );
		}

		if ( $this->handle_with_method ) {
			return call_user_func_array( array( $this, $this->handle_with_method ), func_get_args() );
		}

		return func_get_arg( 0 );

	}

}
