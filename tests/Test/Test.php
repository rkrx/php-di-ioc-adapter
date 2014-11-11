<?php
namespace DIAdapter\Test;

class Test {
	/**
	 * @var Test2
	 */
	private $test2;

	/**
	 * @param Test2 $test2
	 */
	public function __construct(Test2 $test2) {
		$this->test2 = $test2;
	}

	/**
	 * @return Test2
	 */
	public function getTest2() {
		return $this->test2;
	}

	/**
	 * @return string
	 */
	public function returnA() {
		return 'A';
	}

	/**
	 * @param Test2 $test2
	 * @return string
	 */
	public function returnB(Test2 $test2) {
		return $test2->returnB();
	}
}