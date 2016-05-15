<?php

namespace Minetro\SeznamCaptcha;

use Minetro\SeznamCaptcha\Provider\ValidationProvider;

class CaptchaValidator implements Validator
{

	/** @var ValidationProvider */
	private $provider;

	/**
	 * @param ValidationProvider $provider
	 */
	public function __construct(ValidationProvider $provider)
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
