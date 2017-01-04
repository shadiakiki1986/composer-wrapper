# composer-wrapper [![Build Status](https://travis-ci.org/shadiakiki1986/composer-wrapper.svg?branch=master)](https://travis-ci.org/shadiakiki1986/composer-wrapper)
Use composer as a library in your php project

This is different than [eviweb/composer-wrapper](composer require eviweb/composer-wrappe://github.com/eviweb/composer-wrapper)

I should probably choose a different name, but I'm too lazy now

# Installation
`composer require shadiakiki1986/composer-wrapper`

# Usage
Example: Get the output of `composer show --direct` as an array in php:
```php
require_once 'vendor/autoload.php';
$cw = new \shadiakiki1986\ComposerWrapper();
$packages = $cw->showDirect();
```
This will give an associative array with package names as keys and versions as values, e.g. `['composer/composer'=>'1.3.0.0']`
