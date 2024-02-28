<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ThemePlate\Utilities\HookHandler;

class HookHandlerTest extends TestCase {
	public function test_handling() {
		$hook = new class() extends HookHandler {
			public function add_one( $value ) {
				return $value + 1;
			}
		};

		for ( $i = 1; $i <= 3; $i++ ) {
			$this->assertEquals( $i, $hook->handle( $i ) );
			$this->assertEquals( $i + 1, $hook->with( 'add_one' )->handle( $i ) );
		}
	}
}
