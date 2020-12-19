<?php declare(strict_types = 1);

namespace Tests\Fixtures;

use Contributte\SeznamCaptcha\Provider\SeznamCaptcha;

final class FakeSeznamCaptcha extends SeznamCaptcha
{

	public const HASH = 12345;
	public const IMAGE = 'foobar';

	/** @var bool */
	private $pass;

	/**
	 * @param bool $pass
	 */
	public function __construct($pass = true)
	{
		parent::__construct(new FakeCaptcha('https://fake.tld', 12345));
		$this->pass = $pass;
	}

	/**
	 * @return int
	 */
	public function getHash()
	{
		return self::HASH;
	}

	/**
	 * @return string
	 */
	public function getImage()
	{
		return self::IMAGE;
	}

	/**
	 * @param string $code
	 * @param string $hash
	 * @return bool
	 */
	public function validate($code, $hash)
	{
		return $this->pass;
	}

}
