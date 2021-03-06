<?php
namespace DIAdapter;

use DI\Container;
use DIAdapter\Tools\ExceptionHelper;
use Exception;
use Interop\Container\Exception\ContainerException;
use Ioc\Exceptions\DefinitionNotFoundException;
use Ioc\ObjectFactory;

class PhpDiObjectFactory implements ObjectFactory {
	/** @var Container */
	private $container;

	/**
	 * @param Container $container
	 */
	public function __construct(Container $container) {
		$this->container = $container;
	}

	/**
	 * The object-factory creates a class with the name $className and the __construct-arguments $arguments. If
	 * arguments were missing in $arguments, the method-invoker tries to fill the missing arguments by itself.
	 *
	 * @param string $className
	 * @param array $arguments
	 * @throws DefinitionNotFoundException
	 * @throws Exception
	 * @return mixed
	 */
	public function create($className, array $arguments = array()) {
		try {
			return $this->container->make($className, $arguments);
		} catch (ContainerException $e) {
			throw ExceptionHelper::buildException($e, '\\Ioc\\Exceptions\\DefinitionNotFoundException');
		} catch (Exception $e) {
			throw ExceptionHelper::buildException($e, '\\Exception');
		}
	}
}
