<?php

namespace Minetro\SeznamCaptcha\Provider;

interface CaptchaProvider
{

	/**
	 * @return string
	 */
	public function getHash();

	/**
	 * @return string
	 */
	public function getImage();

	/**
	 * @param string $code
	 * @param string $hash
	 * @return bool
	 */
	public function validate($code, $hash);

}
