<?php
namespace DIAdapter;

use DI\ContainerBuilder;

class PhpDiContainerTest extends \PHPUnit_Framework_TestCase {
	public function testObjectFactory() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$factory = new PhpDiObjectFactory($container);
		$instance = $factory->create('DIAdapter\\Test\\Test');

		$this->assertInstanceOf('DIAdapter\\Test\\Test', $instance);
		$this->assertInstanceOf('DIAdapter\\Test\\Test2', $instance->getTest2());
	}

	public function testInstanceContainer() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$container = new PhpDiInstanceContainer($container);
		$instance = $container->get('DIAdapter\\Test\\Test');

		$this->assertInstanceOf('DIAdapter\\Test\\Test', $instance);
		$this->assertInstanceOf('DIAdapter\\Test\\Test2', $instance->getTest2());
	}

	public function testMethodInvoker() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$invoker = new PhpDiMethodInvoker($container);

		$a = $invoker->invoke(array('DIAdapter\\Test\\Test', 'returnA'));
		$this->assertEquals('A', $a);

		$b = $invoker->invoke(array('DIAdapter\\Test\\Test', 'returnB'));
		$this->assertEquals('B', $b);
	}
}
