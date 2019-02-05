<?php

declare(strict_types = 1);

namespace Oops\ContainerAdapter;

use Nette\DI\Container;
use Nette\DI\MissingServiceException;
use Oops\ContainerAdapter\Exception\ContainerException;
use Oops\ContainerAdapter\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;


final class ContainerAdapter implements ContainerInterface
{

	/**
	 * @var Container
	 */
	private $container;


	public function __construct(Container $container)
	{
		$this->container = $container;
	}


	/**
	 * {@inheritdoc}
	 */
	public function get($id)
	{
		try {
			$service = $this->container->getByType($id, FALSE);
			if ($service !== NULL) {
				return $service;
			}

			return $this->container->getService($id);

		} catch (MissingServiceException $e) {
			throw new ServiceNotFoundException($e);

		} catch (\Throwable $e) {
			throw new ContainerException($e);
		}
	}


	/**
	 * {@inheritdoc}
	 */
	public function has($id)
	{
		return $this->container->getByType($id, FALSE) !== NULL || $this->container->hasService($id);
	}

}
