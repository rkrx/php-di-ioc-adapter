<?php
namespace DIAdapter\Tools;

use Exception;

class ExceptionHelper {
	/**
	 * @param Exception $exception
	 * @param string $exceptionType
	 */
	public static function buildException(Exception $exception, $exceptionType) {
		$message = $exception->getMessage();
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
		if(!is_scalar($code) && !is_null($code)) {
			$message = sprintf($errorMsg, 'code', gettype($code));
			$code = -1;
		}
		if(!$exception instanceof Exception) {
			$message = sprintf($errorMsg, 'exception', gettype($exception));
			$code = -1;
			$exception = null;
		}
		return new $exceptionType($message, $code, $exception);
	}
}