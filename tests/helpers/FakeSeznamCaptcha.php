<?php

use Minetro\SeznamCaptcha\Provider\SeznamCaptcha;

final class FakeSeznamCaptcha extends SeznamCaptcha
{

	const HASH = 12345;
	const IMAGE = 'foobar';

	/** @var bool */
	private $pass;

	/**
	 * @param bool $pass
	 */
	public function __construct($pass = TRUE)
	{
		$this->pass = $pass;
		// not call parent..
	}

	public function getHash()
	{
		return self::HASH;
	}

	public function getImage()
	{
		return self::IMAGE;
	}

	public function validate($code, $hash)
	{
		return $this->pass;
	}

}
