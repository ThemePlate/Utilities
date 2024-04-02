<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Utilities;

use Stringable;

class ClassNames implements Stringable {

	protected array $collection;


	public function __construct( array $collection ) {

		$this->collection = explode( ' ', implode( ' ', $collection ) );

	}


	protected function filter( string $identifier ): array {

		return array_filter( $this->collection, fn( $name ) => preg_match( '/' . $identifier . '/', $name ) );

	}


	public function utility( string $key ): array {

		return array_values( $this->filter( $key . '-' ) );

	}


	public function modifier( string $key ): array {

		return array_values( $this->filter( $key . ':' ) );

	}


	public function __toString(): string {

		return implode( ' ', $this->collection );

	}

}
