<?php
namespace DIAdapter;

use DI\Container;
use Interop\Container\Exception\ContainerException;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\ObjectFactory;

class PhpDiObjectFactory implements ObjectFactory {
	/**
	 * @var Container
	 */
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
	 * @param string $className
	 * @param array $arguments
	 * @throws DefinitionNotFoundException
	 * @return mixed
	 */
	public function create($className, array $arguments = array()) {
		try {
			return $this->container->make($className, $arguments);
		} catch (ContainerException $e) {
			throw new DefinitionNotFoundException($e->getMessage(), $e->getCode());
		}
	}
}