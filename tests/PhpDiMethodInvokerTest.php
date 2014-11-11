<?php
namespace DIAdapter;

use DI\ContainerBuilder;

class PhpDiMethodInvokerTest extends \PHPUnit_Framework_TestCase {
	public function test() {
		$builder = new ContainerBuilder();
		$container = $builder->build();
		$invoker = new PhpDiMethodInvoker($container);

		$a = $invoker->invoke(array('DIAdapter\\Test\\Test', 'returnA'));
		$this->assertEquals('A', $a);

		$b = $invoker->invoke(array('DIAdapter\\Test\\Test', 'returnB'));
		$this->assertEquals('B', $b);
	}
}
