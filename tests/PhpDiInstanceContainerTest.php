<?php
namespace DIAdapter;

use DI\ContainerBuilder;
use DIAdapter\Test\Test;
use DIAdapter\Test\Test2;
use PHPUnit\Framework\TestCase;

class PhpDiInstanceContainerTest extends TestCase {
	public function test() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$container = new PhpDiInstanceContainer($container);
		$instance = $container->get(Test::class);

		$this->assertInstanceOf(Test::class, $instance);
		$this->assertInstanceOf(Test2::class, $instance->getTest2());
	}
}
