<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Repository\GameRepository' shared autowired service.

return $this->privates['App\\Repository\\GameRepository'] = new \App\Repository\GameRepository(($this->services['doctrine'] ?? $this->getDoctrineService()));
