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

		$this->collection = explode( ' ', implode( ' ', $this->flatten( $collection ) ) );

	}


	protected function flatten( array $collection ): array {

		return array_reduce(
			$collection,
			function ( $carry, $item ) {
				if ( is_array( $item ) ) {
					$carry = array_merge( $carry, $this->flatten( $item ) );
				} else {
					$carry[] = $item;
				}

				return $carry;
			},
			array()
		);

	}


	protected function filter( string $identifier ): array {

		return array_filter( $this->collection, fn( $name ) => preg_match( '/' . $identifier . '/', $name ) );

	}


	public function utility( string $key, bool $grouped = false ): array {

		$values = array_values( $this->filter( $key . '-' ) );

		if ( $grouped ) {
			$values = $this->group( $values, '/(?P<key>[^:]+):(?P<value>[^-]+-.+)/' );
		}

		return $values;

	}


	public function modifier( string $key, bool $grouped = false ): array {

		$values = array_values( $this->filter( $key . ':' ) );

		if ( $grouped ) {
			$values = $this->group( $values, '/[^:]+:(?P<value>(?P<key>[^-]+)-.+)/' );
		}

		return $values;

	}


	public function __toString(): string {

		return implode( ' ', $this->collection );

	}


	protected function group( array $collection, string $pattern ): array {

		return array_reduce(
			$collection,
			static function ( $carry, $name ) use ( $pattern ) {
				if ( preg_match( $pattern, $name, $matched ) ) {
					$carry[ $matched['key'] ][] = $matched['value'];
				} else {
					$carry['base'][] = $name;
				}

				return $carry;
			},
			array()
		);

	}

}
