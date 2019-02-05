<?php

declare(strict_types = 1);

namespace Oops\ContainerAdapter\Exception;

use Nette\DI\MissingServiceException;
use Psr\Container\NotFoundExceptionInterface;


final class ServiceNotFoundException extends \Exception implements NotFoundExceptionInterface
{

	public function __construct(MissingServiceException $e)
	{
		parent::__construct($e->getMessage(), $e->getCode(), $e);
	}

}
