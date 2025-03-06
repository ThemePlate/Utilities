<?php

namespace Tests\Integration;

use Tests\Fixtures\HooksTest;
use WP_UnitTestCase;

class HookHandlerTest extends WP_UnitTestCase {
	protected HooksTest $hook;

	protected function setUp(): void {
		$this->hook = new HooksTest( $this );

		add_filter( 'tester_hook_context', array( $this->hook->with( 'prefixed' ), 'handle' ) );
	}

	public function test_handling(): void {
		$hook = $this->hook;

		add_filter( 'tester_hook', array( $hook->with( 'add_one' ), 'handle' ) );
		add_filter( 'tester_hook_once', array( $hook->with( 'add_one' )->once(), 'handle' ) );
		add_filter( 'tester_hook_priority', array( $hook->with( 'add_one' )->once(), 'handle' ), 911 );

		for ( $i = 1; $i <= 3; $i++ ) {
			$this->assertEquals( $i + 1, apply_filters( 'tester_hook', $i ) );

			$value = $i;

			if ( 1 === $i ) {
				++$value;
			}

			$this->assertEquals( $value, apply_filters( 'tester_hook_once', $i ) );
			$this->assertEquals( $value, apply_filters( 'tester_hook_priority', $i ) );
		}

		$this->assertStringStartsWith( $this->name(), apply_filters( 'tester_hook_context', '!' ) );
		$this->assertSame( $this->name() . '!', apply_filters( 'tester_hook_context', '!' ) );
	}
}
