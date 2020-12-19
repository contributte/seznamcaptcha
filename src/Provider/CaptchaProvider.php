<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\Provider;

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
