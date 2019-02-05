<?php

namespace OopsTests\ContainerAdapter\DI;

use Nette\Configurator;
use Nette\DI\Container;
use Psr\Container\ContainerInterface;
use Tester\Assert;
use Tester\TestCase;


require_once __DIR__ . '/../../bootstrap.php';


/**
 * @testCase
 */
final class ContainerAdapterExtensionTest extends TestCase
{

	public function testExtension(): void
	{
		$container = $this->createContainer();

		$adapter = $container->getByType(ContainerInterface::class, FALSE);
		Assert::notSame(NULL, $adapter);

		$reflection = new \ReflectionClass($adapter);
		$property = $reflection->getProperty('container');
		$property->setAccessible(TRUE);
		$innerContainer = $property->getValue($adapter);
		Assert::same($innerContainer, $container);
	}


	private function createContainer(): Container
	{
		$configurator = new Configurator();
		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig(__DIR__ . '/config.neon');

		return $configurator->createContainer();
	}

}


(new ContainerAdapterExtensionTest())->run();
