<?php

namespace Minetro\SeznamCaptcha\Forms;

use Minetro\SeznamCaptcha\CaptchaValidator;
use Minetro\SeznamCaptcha\Provider\CaptchaProvider;
use Minetro\SeznamCaptcha\Provider\SeznamCaptcha;
use Minetro\SeznamCaptcha\Provider\ValidationProvider;
use Minetro\SeznamCaptcha\Validator;
use Nette\Forms\Container;

class CaptchaContainer extends Container
{

	/** @var CaptchaProvider|ValidationProvider */
	private $provider;

	/** @var Validator */
	private $validator;

	/**
	 * @param SeznamCaptcha $provider
	 */
	public function __construct(SeznamCaptcha $provider)
	{
		parent::__construct();
		$this->provider = $provider;
		$this->validator = new CaptchaValidator($provider);

		$this['image'] = new CaptchaImage('Captcha', $provider);
		$this['code'] = new CaptchaInput('Code');
		$this['hash'] = new CaptchaHash($provider);
	}

	/**
	 * @return CaptchaImage
	 */
	public function getImage()
	{
		return $this['image'];
	}

	/**
	 * @return CaptchaInput
	 */
	public function getCode()
	{
		return $this['code'];
	}

	/**
	 * @return CaptchaHash
	 */
	public function getHash()
	{
		return $this['hash'];
	}

	/**
	 * @return Validator
	 */
	public function getValidator()
	{
		return $this->validator;
	}

	/**
	 * @return bool
	 */
	public function verify()
	{
		$form = $this->getForm(TRUE);
		$code = $form->getHttpData($form::DATA_LINE, $this->getCode()->getHtmlName());
		$hash = $form->getHttpData($form::DATA_LINE, $this->getHash()->getHtmlName());

		return $this->validator->validate($code, $hash);
	}

}
