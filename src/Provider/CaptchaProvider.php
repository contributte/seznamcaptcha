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

}
