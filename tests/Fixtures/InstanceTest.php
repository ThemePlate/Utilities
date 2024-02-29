<?php

namespace Tests\Fixtures;

use ThemePlate\Utilities\Instantiable;

class InstanceTest {
	use Instantiable;

	private string $value;

	public function get_value(): string {
		if ( ! isset( $this->value ) ) {
			$this->value = $this->random_value();
		}

		return $this->value;
	}

	public function random_value(): string {
		return random_bytes( random_int( 1, 9 ) );
	}
}
