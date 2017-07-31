<?php

namespace Contributte\SeznamCaptcha\Forms;

use Contributte\SeznamCaptcha\CaptchaValidator;
use Contributte\SeznamCaptcha\Provider\CaptchaProvider;
use Contributte\SeznamCaptcha\Validator;
use Nette\Forms\Container;

class CaptchaContainer extends Container
{

	/** @var Validator */
	private $validator;

	/**
	 * @param CaptchaProvider $provider
	 */
	public function __construct(CaptchaProvider $provider)
	{
		parent::__construct();
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
	 * @param mixed $validator
	 * @param mixed $message
	 * @param mixed $arg
	 * @return CaptchaInput
	 */
	public function addRule($validator, $message = NULL, $arg = NULL)
	{
		return $this->getCode()->addRule($validator, $message, $arg);
	}

	/**
	 * @param string $message
	 * @return CaptchaInput
	 */
	public function setRequired($message)
	{
		return $this->addRule(function ($code) {
			return $this->verify() === TRUE;
		}, $message);
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
