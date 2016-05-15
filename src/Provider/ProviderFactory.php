<?php

namespace Minetro\SeznamCaptcha\Provider;

interface ProviderFactory
{

	/**
	 * @return CaptchaProvider
	 */
	public function create();

}
