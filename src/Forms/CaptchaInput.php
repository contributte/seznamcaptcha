<?php declare(strict_types = 1);

namespace Contributte\SeznamCaptcha\Forms;

use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;

class CaptchaInput extends TextInput
{

	/**
	 * @param string $label
	 * @param int $maxLength
	 */
	public function __construct($label, $maxLength = 5)
	{
		parent::__construct($label, $maxLength);
		$this->control->addClass('captcha-input seznam-captcha-input');
	}

	/**
	 * @return string
	 */
	public function getCode()
	{
		return $this->getValue();
	}

	/**
	 * @return string
	 */
	public function getHttpCode()
	{
		return $this->getHttpData(Form::DATA_LINE);
	}

}
