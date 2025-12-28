![](https://heatbadger.now.sh/github/readme/contributte/seznamcaptcha/?deprecated=1)

<p align=center>
    <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
    <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
    <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
    Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

## Disclaimer

| :warning: | This project is no longer being maintained.
|---|---|

| Composer | [`contributte/seznamcaptcha`](https://packagist.org/packages/contributte/seznamcaptcha) |
|---|---|
| Version | ![](https://badgen.net/packagist/v/contributte/seznamcaptcha) |
| PHP | ![](https://badgen.net/packagist/php/contributte/seznamcaptcha) |
| License | ![](https://badgen.net/github/license/contributte/seznamcaptcha) |

## Usage

To install latest version of `contributte/seznamcaptcha` use [Composer](https://getcomposer.org).

```bash
composer require contributte/seznamcaptcha
```

## Configuration

### Extension Registration

```neon
extensions:
	captcha: Contributte\SeznamCaptcha\DI\SeznamCaptchaExtension
```

### Options

By default is `auto: on` and `method: http`, you can disable it and bind addCaptcha to your forms by yourself.

```neon
captcha:
	auto: off # on | off
	method: xmlrpc # http | xmlrpc
```

## Form

Just register an extension and keep `auto` argument as it is.

```php
use Nette\Application\UI\Form;

protected function createComponentForm()
{
	$form = new Form();

	$form->addCaptcha('captcha')
		->setRequired('Are you robot?');

	$form->addSubmit('send');

	$form->onSuccess[] = function (Form $form) {
		dump($form['captcha']);
	};

	return $form;
}
```

## Rendering

### Automatic

```latte
{control form}
````

### Manual

It needs a `CaptchaContainer` consists of 2 inputs `image` and `code`.

```latte
<form n:name="form">
    {input captcha-image}
    {input captcha-code}
</form>
```

## Advanced Example

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
something like this. You can also create a trait for it.

## Versions

| State       | Version | Branch   | Nette | PHP     |
|-------------|---------|----------|-------|---------|
| dev         | `^0.6`  | `master` | 3.0+  | `>=7.2` |
| stable      | `^0.5`  | `master` | 3.0+  | `>=7.2` |
| stable      | `^0.4`  | `master` | 2.4+  | `>=5.6` |

## Development

This package was maintained by these authors.

<a href="https://github.com/f3l1x">
  <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
