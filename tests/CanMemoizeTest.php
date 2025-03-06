<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Fixtures\MemoTest;

final class CanMemoizeTest extends TestCase {
	public function test_memoization(): void {
		$class = new MemoTest();

		$value = $class->public_method();

		$this->assertEquals( $value, $class->public_method() );
		$this->assertEquals( $class->public_method(), $class->public_method() );
		$this->assertEquals( $class->test( '~', '!!!' ), $class->test( '~', '!!!' ) );
		$this->assertEquals( $class->test( '@', '---' ), $class->test( '@', '---' ) );
		$this->assertNotEquals( $class->test( '~', '!!!' ), $class->test( '@', '---' ) );
	}
}
