<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\ObjectFactory;
use Psr\Container\ContainerExceptionInterface;
use Throwable;

class PhpDiObjectFactory implements ObjectFactory {
	public function __construct(
		private Container $container
	) {}

	/**
	 * The object-factory creates a class with the name $className and the __construct-arguments $arguments. If
	 * arguments were missing in $arguments, the method-invoker tries to fill the missing arguments by itself.
	 *
	 * @template T
	 * @param class-string<T> $className
	 * @param array<mixed, mixed> $arguments
	 * @throws DefinitionNotFoundException
	 * @throws Throwable
	 * @return T
	 */
	public function create(string $className, array $arguments = []) {
		try {
			return $this->container->make($className, $arguments);
		} catch (ContainerExceptionInterface $e) {
			throw ExceptionHelper::buildException($e, DefinitionNotFoundException::class);
		} catch (Exception $e) {
			throw ExceptionHelper::buildException($e, Exception::class);
		}
	}
}
