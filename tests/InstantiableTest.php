<?php

declare(strict_types=1);

namespace Tests;

use Tests\Fixtures\InstanceTest;
use PHPUnit\Framework\TestCase;

final class InstantiableTest extends TestCase {
	public function test_instances(): void {
		$class1 = InstanceTest::instance();
		$class2 = InstanceTest::instance();

		$this->assertSame( $class1, $class2 );

		$class1->random_value();
		$class2->random_value();
		$this->assertSame( $class1->get_value(), $class2->get_value() );
	}
}
