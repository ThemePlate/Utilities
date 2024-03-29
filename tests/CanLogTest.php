<?php

namespace Tests;

use Psr\Log\LoggerInterface;
use Tests\Fixtures\LoggerTest;
use PHPUnit\Framework\TestCase;
use ThemePlate\Utilities\CanLog;

class CanLogTest extends TestCase {
	public function test_no_logger() {
		$class = new class() {
			use CanLog;

			public function method() {
				$this->log( __METHOD__ );

				return true;
			}
		};

		ob_start();
		$class->method();
		$this->assertSame( '', ob_get_clean() );
	}

	public function test_has_logger() {
		$logger = new LoggerTest();
		$class  = new class( $logger ) {
			use CanLog;

			public function __construct( LoggerInterface $logger ) {
				$this->logger = $logger;
			}

			public function method() {
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
