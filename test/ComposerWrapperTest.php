<?php

namespace shadiakiki1986;

class ComposerWrapperTest extends \PHPUnit_Framework_TestCase
{

    public function testLocal()
    {
      $cw = new ComposerWrapper();
      $packages = $cw->showDirect();
      $expected = [
        "composer/composer" => "1.3.0.0",
        "jakub-onderka/php-parallel-lint" => "0.9.2.0",
         "phpunit/phpunit" => "5.7.5.0"
      ];
      $this->assertEquals($expected,$packages);
    }

    public function testCanSpecifyAComposerJson()
    {
      $cw = new ComposerWrapper(__DIR__.'/../vendor/composer/composer/composer.json');
      $packages = $cw->showDirect();
      $expected = [
        "symfony/process"=>"3.2.1.0",
        "symfony/finder"=>"3.2.1.0",
        "symfony/filesystem"=>"3.2.1.0",
        "psr/log"=>"1.0.2.0",
        "symfony/console"=>"3.2.1.0",
        "seld/phar-utils"=>"1.0.1.0",
        "seld/jsonlint"=>"1.5.0.0",
        "seld/cli-prompt"=>"1.0.2.0",
        "justinrainbow/json-schema"=>"4.1.0.0",
        "composer/spdx-licenses"=>"1.1.5.0",
        "composer/semver"=>"1.4.2.0",
        "composer/ca-bundle"=>"1.0.6.0",
        "phpunit/phpunit-mock-objects"=>"3.4.3.0",
        "phpunit/phpunit"=>"5.7.5.0"
      ];
      $this->assertEquals($expected,$packages);
    }

}
