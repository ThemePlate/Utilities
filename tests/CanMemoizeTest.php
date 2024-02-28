<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ThemePlate\Utilities\CanMemoize;

class CanMemoizeTest extends TestCase {
	public function test_memoization() {
		$class = new class() {
			use CanMemoize;

			public function public_method(): string {
				return $this->memoize( 'expensive_method', array( '...', '!' ) );
			}

			public function expensive_method( string $prefix, string $suffix ): string {
				return $prefix . random_bytes( random_int( 1, 9 ) ) . $suffix;
			}
		};

		$value = $class->public_method();

		$this->assertEquals( $value, $class->public_method() );
		$this->assertEquals( $class->public_method(), $class->public_method() );
	}
}
