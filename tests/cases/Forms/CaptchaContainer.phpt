<?php

/**
 * Test: Forms/CaptchaContainer
 */

use Minetro\SeznamCaptcha\Forms\CaptchaContainer;
use Minetro\SeznamCaptcha\Forms\CaptchaHash;
use Minetro\SeznamCaptcha\Forms\CaptchaImage;
use Minetro\SeznamCaptcha\Forms\CaptchaInput;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

test(function () {
	$factory = new FakeProviderFactory();
	$captcha = new CaptchaContainer($factory->create());
	Assert::type(CaptchaImage::class, $captcha['image']);
	Assert::type(CaptchaInput::class, $captcha['code']);
	Assert::type(CaptchaHash::class, $captcha['hash']);

	Assert::equal(FakeSeznamCaptcha::HASH, $captcha['hash']->getHash());
	Assert::equal(FakeSeznamCaptcha::IMAGE, $captcha['image']->getImage());
});

test(function () {
	$captcha = new CaptchaContainer(new FakeSeznamCaptcha($pass = true));
	$validator = $captcha->getValidator();

	// Always true, because of FakeSeznamCaptcha($pass)
	Assert::true($validator->validate('foo', 'bar'));
});


test(function () {
	$captcha = new CaptchaContainer(new FakeSeznamCaptcha($pass = FALSE));
	$validator = $captcha->getValidator();

	// Always false, because of FakeSeznamCaptcha($pass)
	Assert::false($validator->validate('foo', 'bar'));
});
