<?php
namespace DIAdapter;

use DI\ContainerBuilder;
use DIAdapter\Test\Test;
use PHPUnit\Framework\TestCase;

class PhpDiMethodInvokerTest extends TestCase {
	public function test() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$invoker = new PhpDiMethodInvoker($container);

		$a = $invoker->invoke(array(Test::class, 'returnA'));
		$this->assertEquals('A', $a);

		$b = $invoker->invoke(array(Test::class, 'returnB'));
		$this->assertEquals('B', $b);
	}
}
