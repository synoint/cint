<?php

namespace Syno\Cint\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class SynoCintExtension extends ConfigurableExtension
{
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../../config'));
        $loader->load('services.yml');

        $connect = $mergedConfig['connect'] ?? [];
        if (!empty($connect['account_id']) && !empty($connect['username']) && !empty($connect['password'])) {
            $connectConfigDef = $container->getDefinition('syno.cint.connect.config');
            $connectConfigDef->replaceArgument(0, $connect['account_id']);
            $connectConfigDef->replaceArgument(1, $connect['username']);
            $connectConfigDef->replaceArgument(2, $connect['password']);
        } else {
            $connectResources = $container->findTaggedServiceIds('syno.cint.connect_resource');
            foreach ($connectResources as $connectResourceId) {
                $container->removeDefinition($connectResourceId);
            }
        }
    }
}
