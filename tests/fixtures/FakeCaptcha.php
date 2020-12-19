<?php declare(strict_types = 1);

namespace Tests\Fixtures;

use Captcha;

final class FakeCaptcha extends Captcha
{

	/**
	 * @param string $hash
	 * @return mixed
	 */
	public function getImage($hash)
	{
		return $hash;
	}

	/**
	 * @param string $hash
	 * @return mixed
	 */
	public function getAudio($hash)
	{
		return $hash;
	}

	/**
	 * @param string $hash
	 * @param string $code
	 * @return mixed
	 */
	public function check($hash, $code)
	{
		return $hash;
	}

	/**
	 * @return static
	 */
	public function create()
	{
		return new self('https://fake.tld', 123456);
	}

}
