# composer-wrapper [![Build Status](https://travis-ci.org/shadiakiki1986/composer-wrapper.svg?branch=master)](https://travis-ci.org/shadiakiki1986/composer-wrapper)
Use composer as a library in your php project

This is different than [eviweb/composer-wrapper](composer require eviweb/composer-wrappe://github.com/eviweb/composer-wrapper)

I should probably choose a different name, but I'm too lazy now

Answers SO [Run composer with a PHP script in browser](http://stackoverflow.com/a/41464759/4126114)

# Installation
`composer require shadiakiki1986/composer-wrapper`

# Usage

## Example 1
Get the output of `composer show --direct` as an array in php:
```php
require_once 'vendor/autoload.php';

$cw = new \shadiakiki1986\ComposerWrapper();
$packages = $cw->showDirect();
```
This will give an associative array with package names as keys and versions as values, e.g. `['composer/composer'=>'1.3.0.0']`



## Example 2
As above, but with specifying a different project composer.json:
```php
require_once 'vendor/autoload.php';

// note that the below createComposer function supports passing in a ''localConfig'' parameter, as well as ''cwd'' parameter
// Check https://github.com/composer/composer/blob/master/src/Composer/Factory.php#L263
$io = new \Composer\IO\NullIO();
$factory = new \Composer\Factory();
$composer = $factory->createComposer($io,'/path/to/another/composer.json');

$cw = new \shadiakiki1986\ComposerWrapper($composer);
$packages = $cw->showDirect();
```
