<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\MethodInvoker;
use Psr\Container\ContainerExceptionInterface;

class PhpDiMethodInvoker implements MethodInvoker {
	public function __construct(
		private Container $container
	) {}

	/**
	 * Invokes the callable $callable with the arguments $arguments. If arguments were missing in $arguments, the
	 * method-invoker tries to fill the missing arguments by itself.
	 *
	 * @param callable $callable
	 * @param array<mixed, mixed> $arguments
	 * @throws DefinitionNotFoundException
	 * @throws Exception
	 * @return mixed
	 */
	public function invoke($callable, array $arguments = []) {
		try {
			return $this->container->call($callable, $arguments);
		} catch (ContainerExceptionInterface $e) {
			throw ExceptionHelper::buildException($e, DefinitionNotFoundException::class);
		} catch (Exception $e) {
			throw ExceptionHelper::buildException($e, Exception::class);
		}
	}
}
