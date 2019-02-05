<?php

namespace OopsTests\ContainerAdapter;

use Mockery;
use Nette\DI\Container;
use Nette\DI\MissingServiceException;
use Oops\ContainerAdapter\ContainerAdapter;
use Oops\ContainerAdapter\Exception\ContainerException;
use Oops\ContainerAdapter\Exception\ServiceNotFoundException;
use Tester\Assert;
use Tester\TestCase;


require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
final class ContainerAdapterTest extends TestCase
{

	public function testGetByType(): void
	{
		$container = Mockery::mock(Container::class);
		$container->shouldReceive('getByType')
			->with(FooService::class, FALSE)
			->once()
			->andReturn($fooService = new FooService());

		$container->shouldReceive('getService')
			->never();

		$adapter = new ContainerAdapter($container);
		Assert::same($fooService, $adapter->get(FooService::class));
	}


	public function testGetByName(): void
	{
		$container = Mockery::mock(Container::class);
		$container->shouldReceive('getByType')
			->with('foo', FALSE)
			->once()
			->andReturnNull();

		$container->shouldReceive('getService')
			->with('foo')
			->once()
			->andReturn($fooService = new FooService());

		$adapter = new ContainerAdapter($container);
		Assert::same($fooService, $adapter->get('foo'));
	}


	public function testMissingService(): void
	{
		$container = Mockery::mock(Container::class);
		$container->shouldReceive('getByType')
			->with('missingService', FALSE)
			->once()
			->andReturnNull();

		$container->shouldReceive('getService')
			->with('missingService')
			->once()
			->andThrow(new MissingServiceException());

		$adapter = new ContainerAdapter($container);
		Assert::throws(function () use ($adapter) {
			$adapter->get('missingService');
		}, ServiceNotFoundException::class);
	}


	public function testGenericException(): void
	{
		$container = Mockery::mock(Container::class);
		$container->shouldReceive('getByType')
			->once()
			->andThrow(new \InvalidArgumentException());

		$adapter = new ContainerAdapter($container);
		Assert::throws(function () use ($adapter) {
			$adapter->get('foo');
		}, ContainerException::class);
	}


	public function testHas(): void
	{
		$container = Mockery::mock(Container::class);
		$container->shouldReceive('getByType')
			->with('foo', FALSE)
			->once()
			->andReturnNull();

		$container->shouldReceive('hasService')
			->with('foo')
			->once()
			->andReturn(TRUE);

		$adapter = new ContainerAdapter($container);
		Assert::true($adapter->has('foo'));
	}


	protected function tearDown()
	{
		parent::tearDown();
		Mockery::close();
	}

}


class FooService
{
}


(new ContainerAdapterTest())->run();
