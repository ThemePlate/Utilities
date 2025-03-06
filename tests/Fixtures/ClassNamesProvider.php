<?php

declare(strict_types=1);

namespace Tests\Fixtures;

final class ClassNamesProvider {
	public const LIST = array(
		'p-4',
		'md:p-8',
		'xl:p-12',
		'text-white',
		'text-left',
		'md:text-center',
		'text-lg',
		'md:text-xl',
		'xl:text-2xl',
		'xl:text-clip',
		'uppercase',
		'font-semibold',
		'border-white',
		'border-b-2',
		'xl:border-b-4',
	);

	public static function for_utility(): array {
		return array(
			array(
				'p',
				array(
					'p-4',
					'md:p-8',
					'xl:p-12',
				),
			),
			array(
				'text',
				array(
					'text-white',
					'text-left',
					'md:text-center',
					'text-lg',
					'md:text-xl',
					'xl:text-2xl',
					'xl:text-clip',
				),
			),
			array(
				'border',
				array(
					'border-white',
					'border-b-2',
					'xl:border-b-4',
				),
			),
		);
	}

	public static function for_utility_grouped(): array {

		return array(
			array(
				'p',
				array(
					'base' => array(
						'p-4',
					),
					'md'   => array(
						'p-8',
					),
					'xl'   => array(
						'p-12',
					),
				),
			),
			array(
				'text',
				array(
					'base' => array(
						'text-white',
						'text-left',
						'text-lg',
					),
					'md'   => array(
						'text-center',
						'text-xl',
					),
					'xl'   => array(
						'text-2xl',
						'text-clip',
					),
				),
			),
			array(
				'border',
				array(
					'base' => array(
						'border-white',
						'border-b-2',
					),
					'xl'   => array(
						'border-b-4',
					),
				),
			),
		);
	}

	public static function for_modifier(): array {
		return array(
			array(
				'md',
				array(
					'md:p-8',
					'md:text-center',
					'md:text-xl',
				),
			),
			array(
				'xl',
				array(
					'xl:p-12',
					'xl:text-2xl',
					'xl:text-clip',
					'xl:border-b-4',
				),
			),
		);
	}

	public static function for_modifier_grouped(): array {
		return array(
			array(
				'md',
				array(
					'p'    => array(
						'p-8',
					),
					'text' => array(
						'text-center',
						'text-xl',
					),
				),
			),
			array(
				'xl',
				array(
					'p'      => array(
						'p-12',
					),
					'text'   => array(
						'text-2xl',
						'text-clip',
					),
					'border' => array(
						'border-b-4',
					),
				),
			),
		);
	}
}
