<?php

namespace Minetro\SeznamCaptcha\Provider;

interface ValidationProvider
{

	/**
	 * @param string $code
	 * @param string $hash
	 * @return bool
	 */
	public function validate($code, $hash);

}
