<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Interop\Container\Exception\ContainerException;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\InstanceContainer;
use Throwable;

class PhpDiInstanceContainer implements InstanceContainer {
	/** @var Container */
	private $container;

	/**
	 * @param Container $container
	 */
	public function __construct(Container $container) {
		$this->container = $container;
	}

	/**
	 * Returns an instance of $className. Is no instance of $className exists, it will be created.
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
		} catch (ContainerException $e) {
			throw ExceptionHelper::buildException($e, DefinitionNotFoundException::class);
		} catch (Exception $e) {
			throw ExceptionHelper::buildException($e, Exception::class);
		}
	}
}
