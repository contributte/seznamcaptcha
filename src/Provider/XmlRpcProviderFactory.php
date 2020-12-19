<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\Provider;

use CaptchaXMLRPC;

final class XmlRpcProviderFactory implements ProviderFactory
{

	/**
	 * @return SeznamCaptcha
	 */
	public function create()
	{
		return new SeznamCaptcha(new CaptchaXMLRPC('captcha.seznam.cz', 3410));
	}

}
