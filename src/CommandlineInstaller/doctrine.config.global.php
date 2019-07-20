<?php
return [
	'doctrine' => [
		'connection' => [
			// default connection name
			'orm_default' => [
				'driverClass' => 'pdo_mysql',
				'params' => [
					'host' => 'localhost',
					'port' => '3306',
					'driverOptions' => [
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					],
				],
			],
		],
	],
];