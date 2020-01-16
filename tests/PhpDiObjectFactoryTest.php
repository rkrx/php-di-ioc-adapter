<?php
namespace DIAdapter;

use DI\ContainerBuilder;
use DIAdapter\Test\Test;
use DIAdapter\Test\Test2;
use PHPUnit\Framework\TestCase;

class PhpDiObjectFactoryTest extends TestCase {
	public function test() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$factory = new PhpDiObjectFactory($container);
		$instance = $factory->create(Test::class);

		$this->assertInstanceOf(Test::class, $instance);
		$this->assertInstanceOf(Test2::class, $instance->getTest2());
	}
}
