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
	    parent::__construct(new FakeCaptcha('https://fake.tld', 12345));
		$this->pass = $pass;
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
