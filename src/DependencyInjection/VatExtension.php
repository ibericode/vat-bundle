<?php

namespace Ibericode\Vat\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class VatExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
         $loader = new YamlFileLoader(
             $container,
             new FileLocator(dirname(__DIR__, 1) . '/config')
         );
        $loader->load('services.yaml');
    }
}
