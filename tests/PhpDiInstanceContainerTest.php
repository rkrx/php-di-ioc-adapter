<?php
namespace DIAdapter;

use DI\ContainerBuilder;

class PhpDiInstanceContainerTest extends \PHPUnit_Framework_TestCase {
	public function test() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$container = new PhpDiInstanceContainer($container);
		$instance = $container->get('DIAdapter\\Test\\Test');

		$this->assertInstanceOf('DIAdapter\\Test\\Test', $instance);
		$this->assertInstanceOf('DIAdapter\\Test\\Test2', $instance->getTest2());
	}
}
