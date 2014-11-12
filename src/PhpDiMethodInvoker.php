<?php
namespace DIAdapter;

use DI\Container;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\MethodInvoker;

class PhpDiMethodInvoker implements MethodInvoker {
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
	 * Invokes the callable $callable with the arguments $arguments. If arguments were missing in $arguments, the
	 * method-invoker tries to fill the missing arguments by itself.
	 * @param $callable
	 * @param array $arguments
	 * @throws DefinitionNotFoundException
	 * @return mixed
	 */
	public function invoke($callable, array $arguments = array()) {
		try {
			return $this->container->call($callable, $arguments);
		} catch (\Exception $e) {
			throw new DefinitionNotFoundException($e->getMessage(), $e->getCode());
		}
	}
}