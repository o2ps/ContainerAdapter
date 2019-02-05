<?php

declare(strict_types = 1);

namespace Oops\ContainerAdapter\DI;

use Nette\DI\CompilerExtension;
use Oops\ContainerAdapter\ContainerAdapter;
use Psr\Container\ContainerInterface;


final class ContainerAdapterExtension extends CompilerExtension
{

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('containerAdapter'))
			->setType(ContainerInterface::class)
			->setFactory(ContainerAdapter::class);
	}

}
