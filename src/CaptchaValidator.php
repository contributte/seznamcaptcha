<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha;

use Contributte\SeznamCaptcha\Provider\CaptchaProvider;

class CaptchaValidator implements Validator
{

	/** @var CaptchaProvider */
	private $provider;

	/**
	 * @param CaptchaProvider $provider
	 */
	public function __construct(CaptchaProvider $provider)
	{
		$this->provider = $provider;
	}

	/**
	 * @param string $code
	 * @param string $hash
	 * @return bool
	 */
	public function validate($code, $hash)
	{
		return $this->provider->validate($code, $hash);
	}

}
