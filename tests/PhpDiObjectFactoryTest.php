<?php
namespace DIAdapter;

use DI\ContainerBuilder;

class PhpDiObjectFactoryTest extends \PHPUnit_Framework_TestCase {
	public function test() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$factory = new PhpDiObjectFactory($container);
		$instance = $factory->create('DIAdapter\\Test\\Test');

		$this->assertInstanceOf('DIAdapter\\Test\\Test', $instance);
		$this->assertInstanceOf('DIAdapter\\Test\\Test2', $instance->getTest2());
	}
}
