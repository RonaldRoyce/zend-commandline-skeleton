<?php

declare (strict_types = 1);

return [
	'commandline' => [
		'modules' => [
			'Application',
		],
		'db' => [
			'adapter' => [
				'driver' => 'PDO_mysql',
				'host' => 'localhost',
				'username' => '',
				'password' => '',
				'dbname' => '',
				'port' => 3306,
			],
		],
	],
];
