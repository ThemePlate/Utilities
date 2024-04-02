<?php

namespace Tests\Fixtures;

class ClassNamesProvider {
	public const LIST = array(
		'p-4',
		'md:p-8',
		'xl:p-12',
		'text-white',
		'text-left',
		'md:text-center',
		'text-lg',
		'xl:text-2xl',
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
					'xl:text-2xl',
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

	public static function for_modifier(): array {
		return array(
			array(
				'md',
				array(
					'md:p-8',
					'md:text-center',
				),
			),
			array(
				'xl',
				array(
					'xl:p-12',
					'xl:text-2xl',
					'xl:border-b-4',
				),
			),
		);
	}
}
