<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Psr\Log\LoggerInterface;
use Stringable;

final class LoggerTester implements LoggerInterface {
	public array $data = array();

	public function log( $level, string|Stringable $message, array $context = array() ): void {
		$this->data = compact( 'level', 'message', 'context' );
	}

	public function emergency( Stringable|string $message, array $context = array() ): void {
		$this->log( 'emergency', $message, $context );
	}

	public function alert( Stringable|string $message, array $context = array() ): void {
		$this->log( 'alert', $message, $context );
	}

	public function critical( Stringable|string $message, array $context = array() ): void {
		$this->log( 'critical', $message, $context );
	}

	public function error( Stringable|string $message, array $context = array() ): void {
		$this->log( 'error', $message, $context );
	}

	public function warning( Stringable|string $message, array $context = array() ): void {
		$this->log( 'warning', $message, $context );
	}

	public function notice( Stringable|string $message, array $context = array() ): void {
		$this->log( 'notice', $message, $context );
	}

	public function info( Stringable|string $message, array $context = array() ): void {
		$this->log( 'info', $message, $context );
	}

	public function debug( Stringable|string $message, array $context = array() ): void {
		$this->log( 'debug', $message, $context );
	}
}
