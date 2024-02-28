<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Utilities;

abstract class HookHandler {

	private string $handle_with_method = '';


	public function with( string $method ): static {

		if ( method_exists( $this, $method ) ) {
			$clone = clone $this;

			$clone->handle_with_method = $method;

			return $clone;
		}

		return $this;

	}


	public function handle(): mixed {

		if ( $this->handle_with_method ) {
			return call_user_func_array( array( $this, $this->handle_with_method ), func_get_args() );
		}

		return func_get_arg( 0 );

	}

}
