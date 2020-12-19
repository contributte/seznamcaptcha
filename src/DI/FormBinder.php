<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\DI;

use Contributte\SeznamCaptcha\Forms\CaptchaContainer;
use Contributte\SeznamCaptcha\Provider\ProviderFactory;
use Nette\Forms\Container;

final class FormBinder
{

	/**
	 * @param ProviderFactory $providerFactory
	 * @return void
	 */
	public static function bind(ProviderFactory $providerFactory)
	{
		Container::extensionMethod('addCaptcha', function ($container, $name = 'captcha', $required = true) use ($providerFactory): CaptchaContainer {
			$field = $container[$name] = new CaptchaContainer($providerFactory->create());
			$field->setRequired($required);

			return $field;
		});
	}

}
