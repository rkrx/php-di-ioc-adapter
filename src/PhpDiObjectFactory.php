<?php
namespace DIAdapter;

use DI\Container;
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
	 * @return mixed
	 */
	public function create($className, array $arguments = array()) {
		return $this->container->make($className, $arguments);
	}
}