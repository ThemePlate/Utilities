<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use ThemePlate\Utilities\CanMemoize;

final class MemoTest {
	use CanMemoize;

	public function public_method(): string {
		return $this->memoize( 'expensive_method', array( '...', '!' ) );
	}

	public function test( string $prefix, string $suffix ): string {
		return $this->memoize( 'expensive_method', array( $prefix, $suffix ) );
	}

	protected function expensive_method( string $prefix, string $suffix ): string {
		return $prefix . random_bytes( random_int( 1, 9 ) ) . $suffix;
	}
}
