<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'nelmio_alice.file_parser.runtime_cache' shared service.

$a = new \Hautelook\AliceBundle\Alice\FileLocator\KernelFileLocator(new \Nelmio\Alice\FileLocator\DefaultFileLocator(), ($this->services['kernel'] ?? $this->get('kernel', 1)));

return $this->privates['nelmio_alice.file_parser.runtime_cache'] = new \Nelmio\Alice\Parser\RuntimeCacheParser(new \Nelmio\Alice\Parser\ParserRegistry([0 => new \Nelmio\Alice\Parser\Chainable\YamlParser(new \Symfony\Component\Yaml\Parser()), 1 => new \Nelmio\Alice\Parser\Chainable\PhpParser(), 2 => new \Nelmio\Alice\Parser\Chainable\JsonParser()]), $a, new \Nelmio\Alice\Parser\IncludeProcessor\DefaultIncludeProcessor($a));