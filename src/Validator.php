<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha;

interface Validator
{

	/**
	 * @param string $code
	 * @param string $hash
	 * @return bool
	 */
	public function validate($code, $hash);

}
