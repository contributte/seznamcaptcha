<?php

namespace Minetro\SeznamCaptcha\DI;

use Minetro\SeznamCaptcha\Forms\CaptchaContainer;
use Minetro\SeznamCaptcha\Provider\ProviderFactory;
use Nette\Forms\Container;

final class FormBinder
{

	/**
	 * @param ProviderFactory $providerFactory
	 */
	public static function bind(ProviderFactory $providerFactory)
	{
		Container::extensionMethod('addCaptcha', function ($container, $name = 'captcha') use ($providerFactory) {
			return $container[$name] = new CaptchaContainer($providerFactory->create());
		});
	}

}
