<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

namespace ThemePlate\Utilities;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

trait CanLog {

	protected ?LoggerInterface $logger = null;


	protected function log( string $message, string $level = LogLevel::INFO ): void {

		if ( null === $this->logger ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log, WordPress.PHP.DevelopmentFunctions.error_log_print_r
			error_log( strtoupper( $level ) . ' > ' . print_r( $message, true ) );

			return;
		}

		$this->logger->log( $level, $message );

	}

}
