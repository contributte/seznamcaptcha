# SeznamCaptcha

[![Build Status](https://img.shields.io/travis/minetro/seznamcaptcha.svg?style=flat-square)](https://travis-ci.org/minetro/seznamcaptcha)
[![Code coverage](https://img.shields.io/coveralls/minetro/seznamcaptcha.svg?style=flat-square)](https://coveralls.io/r/minetro/seznamcaptcha)
[![Downloads this Month](https://img.shields.io/packagist/dm/minetro/seznamcaptcha.svg?style=flat-square)](https://packagist.org/packages/minetro/seznamcaptcha)
[![Downloads total](https://img.shields.io/packagist/dt/minetro/seznamcaptcha.svg?style=flat-square)](https://packagist.org/packages/minetro/seznamcaptcha)
[![Latest stable](https://img.shields.io/packagist/v/minetro/seznamcaptcha.svg?style=flat-square)](https://packagist.org/packages/minetro/seznamcaptcha)
[![HHVM Status](https://img.shields.io/hhvm/minetro/seznamcaptcha.svg?style=flat-square)](http://hhvm.h4cc.de/package/minetro/seznamcaptcha)

[Seznam Captcha](http://captcha-api.seznam.cz) for Nette Framework / Forms.

## Discussion / Help

[![Join the chat](https://img.shields.io/gitter/room/minetro/nette.svg?style=flat-square)](https://gitter.im/minetro/nette?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

## Install

```sh
composer require minetro/seznamcaptcha
```

## Extension

```yaml
extensions:
	captcha: Minetro\SeznamCaptcha\DI\SeznamCaptchaExtension
```

By default is `auto: on` and `method: http`, you can disable it and bind addCaptcha to your forms by yourself.

```yaml
captcha:
	auto: off # on | off
	method: xmlrpc # http | xmlrpc
```

## Usage

![captcha](https://raw.githubusercontent.com/minetro/seznamcaptcha/master/captcha.png)

### Automatic

Just register an extension and keep `auto` argument as it is.

#### Form component

```php
use Nette\Application\UI\Form;

protected function createComponentForm()
{
    $form = new Form();

    $form->addCaptcha('captcha')
        ->getCode()
        ->setRequired('Captcha code is required');

    $form->addSubmit('send');

    $form->onValidate[] = function (Form $form) {
        if ($form['captcha']->verify() !== TRUE) {
            $form->addError('Are you robot?');
        }
    };

    $form->onSuccess[] = function (Form $form) {
        dump($form['captcha']);
    };

    return $form;
}
```

### Manual

#### Form component

```php
use Minetro\SeznamCaptcha\Forms\CaptchaHash;
use Minetro\SeznamCaptcha\Forms\CaptchaImage;
use Minetro\SeznamCaptcha\Forms\CaptchaInput;
use Minetro\SeznamCaptcha\Provider\CaptchaValidator;
use Minetro\SeznamCaptcha\Provider\ProviderFactory;
use Nette\Application\UI\Form;

/** @var ProviderFactory @inject */
public $providerFactory;

protected function createComponentForm()
{
    $form = new Form();

    $provider = $this->providerFactory->create();
    $form['image'] = new CaptchaImage('Captcha', $provider);
    $form['hash'] = new CaptchaHash($provider);
    $form['code'] = new CaptchaInput('Code');

    $form->addSubmit('send');

    $form->onValidate[] = function (Form $form) use ($provider) {
        $validator = new CaptchaValidator($provider);

        $hash = $form['hash']->getHttpHash();
        $code = $form['code']->getHttpCode();

        if ($validator->validate($code, $hash) !== TRUE) {
            $form->addError('Are you robot?');
        }
    };

    $form->onSuccess[] = function (Form $form) {
        dump($form);
    };

    return $form;
}
```

For better usability add this functionality to your `BaseForms`, `BaseFormFactory` or 
something like this.

You can also create a trait for it.

### Rendering

#### Automatic

```
{control form}
````

#### Manual

Needs a `CaptchaContainer`.

```latte
<form n:name="form">
    {input captcha-image}
    {input captcha-code}
</form>

```

-----

Thanks for testing, reporting and contributing.
