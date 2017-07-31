<?php

namespace Contributte\SeznamCaptcha\Provider;

use Captcha;

class SeznamCaptcha implements CaptchaProvider
{

	/** @var Captcha */
	private $captcha;

	/** @var string */
	private $hash;

	/**
	 * @param Captcha $captcha
	 */
	public function __construct(Captcha $captcha)
	{
		$this->captcha = $captcha;
		$this->hash = $captcha->create();
	}

	/**
	 * @return string
	 */
	public function getHash()
	{
		return $this->hash;
	}

	/**
	 * @return string
	 */
	public function getImage()
	{
		return $this->captcha->getImage($this->hash);
	}

	/**
	 * @param string $code
	 * @param string $hash
	 * @return bool
	 */
	public function validate($code, $hash)
	{
		return $this->captcha->check($hash, $code);
	}

}
