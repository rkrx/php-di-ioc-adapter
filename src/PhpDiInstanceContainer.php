<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\InstanceContainer;
use Psr\Container\ContainerExceptionInterface;
use Throwable;

class PhpDiInstanceContainer implements InstanceContainer {
	public function __construct(
		private Container $container
	) {}

	/**
	 * Returns an instance of $className. If no instance of $className exists, it will be created.
	 *
	 * @template T
	 * @param class-string<T> $className
	 * @throws DefinitionNotFoundException
	 * @throws Throwable
	 * @return T
	 */
	public function get($className) {
		try {
			/** @var T $result */
			$result = $this->container->get($className);
			return $result;
		} catch (ContainerExceptionInterface $e) {
			throw ExceptionHelper::buildException($e, DefinitionNotFoundException::class);
		}
	}
}
