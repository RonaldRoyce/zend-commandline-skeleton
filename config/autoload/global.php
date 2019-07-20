<?php
return [
	'commandline' => [
		'modules' => [
			0 => 'Application',
		],
	],
	'doctrine' => [
		'connection' => [
			'orm_default' => [
				'driverClass' => pdo_mysql,
				'params' => [
					'host' => 'localhost',
					'port' => '3306',
					'driverOptions' => [
						1002 => 'SET NAMES utf8',
					],
				],
			],
		],
	],
];
