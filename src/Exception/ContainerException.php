<?php

declare(strict_types = 1);

namespace Oops\ContainerAdapter\Exception;

use Psr\Container\ContainerExceptionInterface;


final class ContainerException extends \Exception implements ContainerExceptionInterface
{

	public function __construct(\Throwable $e)
	{
		parent::__construct($e->getMessage(), $e->getCode(), $e);
	}

}
