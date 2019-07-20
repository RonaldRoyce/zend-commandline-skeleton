<?php
namespace CommandlineInstaller;
use Composer\Factory;
use Composer\Script\Event;
use ZF\Configuration\ConfigResource;

class ComposerScripts {
	protected static $evt;

	public static function postInstall(Event $event) {
		require_once $event
			->getComposer()
			->getConfig()
			->get('vendor-dir') . '/autoload.php';

		$composerFile = Factory::getComposerFile();

		$projectRoot = realpath(dirname($composerFile));
		$projectRoot = rtrim($projectRoot, '/\\') . '/';

		$evt = $event;
		$io = $evt->getIO();

		$io->write("<info>****  Executing post install for zend-commandline-skeleton **********");

		$config = require __DIR__ . "/config.php";
		$doctrineGlobalConfig = require __DIR__ . "/doctrine.config.global.php";
		$doctrineLocalConfig = require __DIR__ . "/doctrine.config.local.php";

		$writer = new \Zend\Config\Writer\PhpArray();

		$writer->setUseClassNameScalars(true);
		$writer->setUseBracketArraySyntax(true);

		self::writeGlobalConfig($writer, $projectRoot, $config);
		self::writeDoctrineConfig($writer, $projectRoot, $doctrineGlobalConfig, $doctrineLocalConfig);

		if (!file_exists($projectRoot . "data")) {
			mkdir($projectRoot . "data");
			mkdir($projectRoot . "data/cache");
		} else if (!file_exists($projectRoot . "data/cache")) {
			mkdir($projectRoot . "data/cache");
		}

		$io->write("<info>****  Post install for zend-commandline-skeleton completed successfully **********");

		static::clearCompiled($event);
	}

	protected static function writeGlobalConfig($writer, $projectRoot, $config) {
		$globalConfig = require __DIR__ . "/../../config/autoload/global.php";

		$configResource = new ConfigResource($globalConfig, $projectRoot . 'config/autoload/global.php', $writer);

		$configResource->patch($config);
	}

	protected static function writeDoctrineConfig($writer, $projectRoot, $configGlobal, $configLocal) {
		$globalConfig = require __DIR__ . "/../../config/autoload/global.php";

		$configResource = new ConfigResource($globalConfig, $projectRoot . 'config/autoload/global.php', $writer);

		$configResource->patch($configGlobal);

		$localFilename = __DIR__ . "/../../config/autoload/local.php";
		$localDistFilename = __DIR__ . "/../../config/autoload/local.php.dist";

		if (!file_exists($localFilename)) {
			if (!file_exists($localDistFilename)) {
				throw new \Exception("local.php and local.php.dist do not exist");
			}

			$localConfig = require $localDistFilename;
		} else {
			$localConfig = require $localFilename;
		}

		$configResource = new ConfigResource($localConfig, $projectRoot . 'config/autoload/local.php', $writer);

		$configResource->patch($configLocal);
	}

	protected static function clearCompiled($event) {
		$io = $event->getIO();

		$io->write('<info>Clear Compiled</info>');
	}
}