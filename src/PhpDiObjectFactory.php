<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Interop\Container\Exception\ContainerException;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\ObjectFactory;
use Throwable;

class PhpDiObjectFactory implements ObjectFactory {
	/** @var Container */
	private $container;

	/**
	 * @param Container $container
	 */
	public function __construct(Container $container) {
		$this->container = $container;
	}

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
	public function create($className, array $arguments = []) {
		try {
			return $this->container->make($className, $arguments);
		} catch (ContainerException $e) {
			throw ExceptionHelper::buildException($e, DefinitionNotFoundException::class);
		} catch (Exception $e) {
			throw ExceptionHelper::buildException($e, Exception::class);
		}
	}
}
