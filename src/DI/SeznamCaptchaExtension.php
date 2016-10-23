<?php

namespace Minetro\SeznamCaptcha\DI;

use Minetro\SeznamCaptcha\Provider\HttpProviderFactory;
use Minetro\SeznamCaptcha\Provider\XmlRpcProviderFactory;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpLiteral;
use Nette\Utils\AssertionException;

final class SeznamCaptchaExtension extends CompilerExtension
{

	/** @var array */
	private $defaults = [
		'auto' => TRUE,
		'method' => 'http',
	];

	/** @var array */
	private static $methods = ['http', 'xmlrpc'];

	/**
	 * Register services
	 */
	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		// Validate methods
		if (!in_array($config['method'], self::$methods)) {
			throw new AssertionException(
				'Method is not valid. Allowed methods are: ' . implode(', ', self::$methods)
			);
		}

		// Add provider
		$providerFactory = $builder->addDefinition($this->prefix('providerFactory'));
		if ($config['method'] === 'http') {
			$providerFactory->setClass(HttpProviderFactory::class);
		} else if ($config['method'] === 'xmlrpc') {
			$providerFactory->setClass(XmlRpcProviderFactory::class);
		}
	}

	/**
	 * @param ClassType $class
	 */
	public function afterCompile(ClassType $class)
	{
		$config = $this->validateConfig($this->defaults);

		if ($config['auto'] === TRUE) {
			$method = $class->getMethod('initialize');
			$method->addBody('?::bind($this->getService(?));', [new PhpLiteral(FormBinder::class), $this->prefix('providerFactory')]);
		}
	}
}
