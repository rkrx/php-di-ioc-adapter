<?php
namespace DIAdapter\Tools;

use Exception;
use Interop\Container\Exception\ContainerException;
use Throwable;

class ExceptionHelper {
	/**
	 * @template T of Throwable
	 * @param Exception|ContainerException $exception
	 * @param class-string<T> $exceptionType
	 */
	public static function buildException($exception, $exceptionType): Throwable {
		/** @var mixed $message */
		$message = $exception->getMessage();
		/** @var mixed $code */
		$code = $exception->getCode();
		$errorMsg = sprintf('Invalid type for exception parameter `%%s`: %%s - thrown in %s:%d', $exception->getFile(), $exception->getLine());
		if(is_object($message) && method_exists($message, '__toString')) {
			$message = (string) $message;
		}
		if(!is_scalar($message) && !is_null($message)) {
			$message = sprintf($errorMsg, 'message', gettype($message));
			$code = -1;
		}
		if(is_object($code) && method_exists($code, '__toString')) {
			$code = (int) (string) $code;
		}
		if(!is_int($code) && !is_null($code)) {
			$message = sprintf($errorMsg, 'code', gettype($code));
			$code = -1;
		}
		if(!is_string($message)) {
			$message = (string) $message;
		}
		if(!is_int($code)) {
			$code = (int) $code;
		}
		if(!$exception instanceof Exception) {
			$message = sprintf($errorMsg, 'exception', gettype($exception));
			$code = -1;
			$exception = null;
		}
		return new $exceptionType($message, $code, $exception);
	}
}
