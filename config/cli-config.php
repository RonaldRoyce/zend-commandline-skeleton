<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Zend\Stdlib\ArrayUtils;
// replace with file to your own project bootstrap
require_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = GetEntityManager();

return ConsoleRunner::createHelperSet($entityManager);

function GetEntityManager() {

	$paths = array(__DIR__ . '/../module/Application/');

	$config = Setup::createAnnotationMetadataConfiguration($paths);
// the connection configuration

	$globalConfig = require __DIR__ . '/../config/autoload/global.php';
	$localConfig = require __DIR__ . '/../config/autoload/local.php';

	$config = ArrayUtils::merge($globalConfig, $localConfig);

	$isDevMode = false;

	$dbParams = array(
		'driver' => $config['doctrine']['connection']['orm_default']['driverClass'],
		'user' => $config['doctrine']['connection']['orm_default']['params']['user'],
		'password' => $config['doctrine']['connection']['orm_default']['params']['password'],
		'dbname' => $config['doctrine']['connection']['orm_default']['params']['dbname'],
	);

	$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
	$entityManager = EntityManager::create($dbParams, $config);

	return $entityManager;
}
