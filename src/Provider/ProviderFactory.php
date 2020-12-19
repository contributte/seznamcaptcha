<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\Provider;

interface ProviderFactory
{

	/**
	 * @return CaptchaProvider
	 */
	public function create();

}
