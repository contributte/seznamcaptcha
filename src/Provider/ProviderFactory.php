<?php

namespace Contributte\SeznamCaptcha\Provider;

interface ProviderFactory
{

	/**
	 * @return CaptchaProvider
	 */
	public function create();

}
