<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

declare(strict_types=1);

namespace ThemePlate\Utilities;

use Stringable;

class ClassNames implements Stringable {

	protected array $collection;


	public function __construct( array $collection ) {

		$this->collection = $this->process( $collection );

	}


	protected function process( array $collection ): array {

		$result = array();

		foreach ( $collection as $key => $value ) {
			if ( is_array( $value ) ) {
				$result = array_merge( $result, $this->process( $value ) );
			} else {
				$temp = $this->parse( (string) $key, $value );

				if ( $temp ) {
					$result[] = $temp;
				}
			}
		}

		return $result;

	}


	protected function parse( string $key, $value ): string {

		if ( is_numeric( $key ) || $value instanceof Stringable ) {
			return (string) $value;
		}

		return $value ? $key : '';

	}


	protected function filter( string $identifier ): array {

		return array_filter( $this->collection, fn( $name ): int|false => preg_match( '/' . $identifier . '/', (string) $name ) );

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
			static function ( array $carry, $name ) use ( $pattern ) {
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
