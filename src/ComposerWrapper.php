<?php

namespace shadiakiki1986;

use Composer\Repository\PlatformRepository;

// code below copied from https://github.com/composer/composer/blob/master/src/Composer/Command/ShowCommand.php
class ComposerWrapper {

  // same parameter as in composer/composer/src/Composer/Factory.php function createComposer
  function __construct(\Composer\Composer $composer=null) {
    if(is_null($composer)) {
      $io = new \Composer\IO\NullIO();
      $factory = new \Composer\Factory();
      $composer = $factory->createComposer($io);
    }
    $this->composer = $composer;
  }

  public function showDirect()
  {
    // init repos
    $platformOverrides = array();
    if ($this->composer) {
        $platformOverrides = $this->composer->getConfig()->get('platform') ?: array();
    }
    $platformRepo = new PlatformRepository(array(), $platformOverrides);
    $phpVersion = $platformRepo->findPackage('php', '*')->getVersion();

    $repos = $installedRepo = $this->composer->getRepositoryManager()->getLocalRepository();

    if ($repos instanceof CompositeRepository) {
        $repos = $repos->getRepositories();
    } elseif (!is_array($repos)) {
        $repos = array($repos);
    }

    // list packages
    $packages = array();

    $packageListFilter = $this->getRootRequires();

    foreach ($repos as $repo) {
        if ($repo === $platformRepo) {
            $type = '<info>platform</info>:';
        } elseif (
            $repo === $installedRepo
            || ($installedRepo instanceof CompositeRepository && in_array($repo, $installedRepo->getRepositories(), true))
        ) {
            $type = '<info>installed</info>:';
        } else {
            $type = '<comment>available</comment>:';
        }
        if ($repo instanceof ComposerRepository && $repo->hasProviders()) {
            foreach ($repo->getProviderNames() as $name) {
                if (!$packageFilter || preg_match($packageFilter, $name)) {
                    $packages[$type][$name] = $name;
                }
            }
        } else {
            foreach ($repo->getPackages() as $package) {
                if (!isset($packages[$type][$package->getName()])
                    || !is_object($packages[$type][$package->getName()])
                    || version_compare($packages[$type][$package->getName()]->getVersion(), $package->getVersion(), '<')
                ) {
                        if (!$packageListFilter || in_array($package->getName(), $packageListFilter, true)) {
                            $packages[$type][$package->getName()] = $package;
                        }
                }
            }
        }
    }

    $packages = (array) $packages;
    $packages = $packages['<info>installed</info>:'];
    array_walk(
      $packages,
      function(&$dep1,$name) {
        $dep1 = (array) $dep1;
        $dep1 = $dep1[array_keys($dep1)[21]];
      }
    );

    return($packages);
  }

  private function getRootRequires()
  {
      $rootPackage = $this->composer->getPackage();
      return array_map(
          'strtolower',
          array_keys(array_merge($rootPackage->getRequires(), $rootPackage->getDevRequires()))
      );
  }

}
