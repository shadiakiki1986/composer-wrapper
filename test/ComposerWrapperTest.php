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
}
