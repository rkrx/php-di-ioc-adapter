<?php
namespace DIAdapter;

use DI\Container;
use Ioc\InstanceContainer;

class PhpDiInstanceContainer implements InstanceContainer {
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
	 * Returns an instance of $className. Is no instance of $className exists, it will be created.
	 * @param string $className
	 * @return object
	 */
	public function get($className) {
		return $this->container->get($className);
	}
}