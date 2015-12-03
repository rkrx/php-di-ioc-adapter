<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Interop\Container\Exception\ContainerException;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\MethodInvoker;

class PhpDiMethodInvoker implements MethodInvoker {
	/** @var Container */
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
	 *
	 * @param callable $callable
	 * @param array $arguments
	 * @throws DefinitionNotFoundException
	 * @throws Exception
	 * @return mixed
	 */
	public function invoke($callable, array $arguments = array()) {
		try {
			return $this->container->call($callable, $arguments);
		} catch (ContainerException $e) {
			throw ExceptionHelper::buildException($e, DefinitionNotFoundException::class);
		} catch (Exception $e) {
			throw ExceptionHelper::buildException($e, Exception::class);
		}
	}
}
