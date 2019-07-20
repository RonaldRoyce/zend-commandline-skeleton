<?php
return [
	'doctrine' => [
		'connection' => [
			// default connection name
			'orm_default' => [
				'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
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