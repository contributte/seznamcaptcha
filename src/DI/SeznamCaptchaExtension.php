<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\DI;

use Contributte\SeznamCaptcha\Provider\HttpProviderFactory;
use Contributte\SeznamCaptcha\Provider\XmlRpcProviderFactory;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpLiteral;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;

/**
 * @property-read stdClass $config
 */
final class SeznamCaptchaExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'auto' => Expect::bool(true),
			'method' => Expect::anyOf('http', 'xmlrpc'),
		]);
	}

	/**
	 * Register services
	 *
	 * @return void
	 */
	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->config;

		// Add provider
		$providerFactory = $builder->addDefinition($this->prefix('providerFactory'));
		if ($config->method === 'http') {
			$providerFactory->setFactory(HttpProviderFactory::class);
		} elseif ($config->method === 'xmlrpc') {
			$providerFactory->setFactory(XmlRpcProviderFactory::class);
		}
	}

	/**
	 * @param ClassType $class
	 * @return void
	 */
	public function afterCompile(ClassType $class)
	{
		$config = $this->config;

		if ($config->auto === true) {
			$method = $class->getMethod('initialize');
			$method->addBody('?::bind($this->getService(?));', [new PhpLiteral(FormBinder::class), $this->prefix('providerFactory')]);
		}
	}

}
