<?php
namespace DIAdapter;

use Ioc\Container;
use DI\Container as DIContainer;

class PhpDiContainer implements Container {
	/**
	 * @var PhpDiObjectFactory
	 */
	private $factory;

	/**
	 * @var PhpDiInstanceContainer
	 */
	private $container;

	/**
	 * @var PhpDiMethodInvoker
	 */
	private $invoker;

	/**
	 * @param DIContainer $container
	 */
	public function __construct(DIContainer $container) {
		$this->factory = new PhpDiObjectFactory($container);
		$this->container = new PhpDiInstanceContainer($container);
		$this->invoker = new PhpDiMethodInvoker($container);
	}

	/**
	 * The object-factory creates a class with the name $className and the __construct-arguments $arguments. If
	 * arguments were missing in $arguments, the method-invoker tries to fill the missing arguments by itself.
	 * @param string $className
	 * @param array $arguments
	 * @return mixed
	 */
	public function create($className, array $arguments = array()) {
		return $this->factory->create($className, $arguments);
	}

	/**
	 * Returns an instance of $className. Is no instance of $className exists, it will be created.
	 * @param string $className
	 * @return object
	 */
	public function get($className) {
		return $this->container->get($className);
	}

	/**
	 * Invokes the callable $callable with the arguments $arguments. If arguments were missing in $arguments, the
	 * method-invoker tries to fill the missing arguments by itself.
	 * @param callable $callable
	 * @param array $arguments
	 * @return mixed
	 */
	public function invoke($callable, array $arguments = array()) {
		return $this->invoker->invoke($callable, $arguments);
	}
}
