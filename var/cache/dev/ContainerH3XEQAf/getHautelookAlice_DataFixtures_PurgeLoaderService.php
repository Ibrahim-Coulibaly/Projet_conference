<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'hautelook_alice.data_fixtures.purge_loader' shared service.

return $this->services['hautelook_alice.data_fixtures.purge_loader'] = new \Fidry\AliceDataFixtures\Loader\FileResolverLoader(($this->services['fidry_alice_data_fixtures.loader.doctrine'] ?? $this->load('getFidryAliceDataFixtures_Loader_DoctrineService.php')), ($this->services['hautelook_alice.resolver.file'] ?? ($this->services['hautelook_alice.resolver.file'] = new \Hautelook\AliceBundle\Resolver\File\KernelFileResolver(($this->services['kernel'] ?? $this->get('kernel', 1))))));
