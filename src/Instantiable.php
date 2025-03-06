<?php

/**
 * @package ThemePlate
 * @since 0.1.0
 */

declare(strict_types=1);

namespace ThemePlate\Utilities;

trait Instantiable {

	protected static ?self $instance = null;


	public static function instance(): self {

		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;

	}

}
