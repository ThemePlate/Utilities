<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Tests\Integration\HookHandlerTest;
use ThemePlate\Utilities\HookHandler;

final class HooksTest extends HookHandler {
	public function __construct( private readonly HookHandlerTest $context ) {
	}

	public function add_one( $value ): int|float {
		return $value + 1;
	}

	public function prefixed( string $value ): string {
		return $this->context->name() . $value;
	}
}
