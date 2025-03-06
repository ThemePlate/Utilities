<?php

namespace Tests\Fixtures;

use Tests\Integration\HookHandlerTest;
use ThemePlate\Utilities\HookHandler;

class HooksTest extends HookHandler {
	private HookHandlerTest $context;

	public function __construct( HookHandlerTest $context ) {

		$this->context = $context;

	}

	public function add_one( $value ): int|float {
		return $value + 1;
	}

	public function prefixed( string $value ): string {
		return $this->context->name() . $value;
	}
}
