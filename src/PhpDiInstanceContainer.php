<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Interop\Container\Exception\ContainerException;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\InstanceContainer;

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
	 * @param string $className
	 * @throws DefinitionNotFoundException
	 * @throws Exception
	 * @return object
	 */
	public function get($className) {
		try {
			return $this->container->get($className);
		} catch (ContainerException $e) {
			throw ExceptionHelper::buildException($e, DefinitionNotFoundException::class);
		} catch (Exception $e) {
			throw ExceptionHelper::buildException($e, Exception::class);
		}
	}
}
