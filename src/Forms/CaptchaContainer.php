<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\Forms;

use Contributte\SeznamCaptcha\CaptchaValidator;
use Contributte\SeznamCaptcha\Provider\CaptchaProvider;
use Contributte\SeznamCaptcha\Validator;
use Nette\Forms\Container;
use Nette\Forms\Form;

class CaptchaContainer extends Container
{

	/** @var Validator */
	private $validator;

	/**
	 * @param CaptchaProvider $provider
	 */
	public function __construct(CaptchaProvider $provider)
	{
		$this->validator = new CaptchaValidator($provider);

		$this['image'] = new CaptchaImage('Captcha', $provider);
		$this['code'] = new CaptchaInput('Code');
		$this['hash'] = new CaptchaHash($provider);
	}

	public function getImage(): CaptchaImage
	{
		return $this['image'];
	}

	public function getCode(): CaptchaInput
	{
		return $this['code'];
	}

	public function getHash(): CaptchaHash
	{
		return $this['hash'];
	}

	public function getValidator(): Validator
	{
		return $this->validator;
	}

	/**
	 * @param mixed $validator
	 * @param mixed $message
	 * @param mixed $arg
	 */
	public function addRule($validator, $message = null, $arg = null): CaptchaInput
	{
		return $this->getCode()->addRule($validator, $message, $arg);
	}

	public function setRequired(string $message): CaptchaInput
	{
		return $this->addRule(function ($code): bool {
			return $this->verify() === true;
		}, $message);
	}

	/**
	 * @return bool
	 */
	public function verify()
	{
		$form = $this->getForm(true);
		assert($form !== null);
		$code = $form->getHttpData(Form::DATA_LINE, $this->getCode()->getHtmlName());
		$hash = $form->getHttpData(Form::DATA_LINE, $this->getHash()->getHtmlName());

		return $this->validator->validate($code, $hash);
	}

}
