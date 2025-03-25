<?php

declare(strict_types=1);

namespace Tests;

use Psr\Log\LoggerInterface;
use Tests\Fixtures\LoggerTester;
use PHPUnit\Framework\TestCase;
use ThemePlate\Utilities\CanLog;

final class CanLogTest extends TestCase {
	public function test_no_logger(): void {
		$class = new class() {
			use CanLog;

			public function method(): true {
				$this->log( __METHOD__ );

				return true;
			}
		};

		ob_start();
		$class->method();
		$this->assertSame( '', ob_get_clean() );
	}

	public function test_has_logger(): void {
		$logger = new LoggerTester();
		$class  = new class( $logger ) {
			use CanLog;

			public function __construct( LoggerInterface $logger ) {
				$this->logger = $logger;
			}

			public function method(): true {
				$this->log( 'YES!' );

				return true;
			}
		};

		$expected = array(
			'level'   => 'info',
			'message' => 'YES!',
			'context' => array(),
		);

		$class->method();
		$this->assertSame( $expected, $logger->data );
	}
}
