<?php

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
