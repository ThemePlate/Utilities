<?php

namespace Tests\Integration;

use ThemePlate\Utilities\HookHandler;
use WP_UnitTestCase;

class HookHandlerTest extends WP_UnitTestCase {
	public function test_handling() {
		$hook = new class() extends HookHandler {
			public function add_one( $value ) {
				return $value + 1;
			}
		};

		add_filter( 'tester_hook', array( $hook->with( 'add_one' ), 'handle' ) );
		add_filter( 'tester_hook_once', array( $hook->with( 'add_one' )->once(), 'handle' ) );

		for ( $i = 1; $i <= 3; $i++ ) {
			$this->assertEquals( $i + 1, apply_filters( 'tester_hook', $i ) );

			$value = $i;

			if ( 1 === $i ) {
				++$value;
			}

			$this->assertEquals( $value, apply_filters( 'tester_hook_once', $i ) );
		}
	}
}
