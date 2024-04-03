<?php

namespace Tests;

use Tests\Fixtures\ClassNamesProvider;
use ThemePlate\Utilities\ClassNames;
use PHPUnit\Framework\TestCase;

class ClassNamesTest extends TestCase {
	private ClassNames $test;

	protected function setUp(): void {
		$this->test = new ClassNames( ClassNamesProvider::LIST );
	}

	protected function stringer( ClassNames $class_names ): string {
		return $class_names;
	}

	protected function asserter( array $expected, array $actual ): void {
		$this->assertIsArray( $actual );
		$this->assertEquals( $expected, $actual );
		$this->assertNotEquals( $this->stringer( $this->test ), $this->stringer( new ClassNames( $actual ) ) );
	}

	public function test_stringable(): void {
		$this->assertIsString( $this->stringer( $this->test ) );
	}

	public function test_flat(): void {
		$non_flat = new ClassNames(
			array(
				'test' => 'this',
				'value',
				'even' => array(
					'now',
				),
				'that' => array(
					'deep' => array(
						'nesting' => 'should',
						'be',
						'flat',
					),
					'last' => 'item',
				),
			)
		);

		$result = $this->stringer( $non_flat );

		$this->assertIsString( $result );
		$this->assertSame( 'this value now should be flat item', $result );
	}

	protected function for_utility(): array {
		return ClassNamesProvider::for_utility();
	}

	/** @dataProvider for_utility */
	public function test_utility( string $key, array $values ): void {
		$this->asserter( $values, $this->test->utility( $key ) );
	}

	protected function for_utility_grouped(): array {
		return ClassNamesProvider::for_utility_grouped();
	}

	/** @dataProvider for_utility_grouped */
	public function test_utility_grouped( string $key, array $values ): void {
		$this->asserter( $values, $this->test->utility( $key, true ) );
	}

	protected function for_modifier(): array {
		return ClassNamesProvider::for_modifier();
	}

	/** @dataProvider for_modifier() */
	public function test_modifier( string $key, array $values ): void {
		$this->asserter( $values, $this->test->modifier( $key ) );
	}

	protected function for_modifier_grouped(): array {
		return ClassNamesProvider::for_modifier_grouped();
	}

	/** @dataProvider for_modifier_grouped() */
	public function test_modifier_grouped( string $key, array $values ): void {
		$this->asserter( $values, $this->test->modifier( $key, true ) );
	}
}
