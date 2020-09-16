<?php

namespace Syno\Cint\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Syno\Cint\Connect;
use Syno\Cint\Demand;
use Syno\Cint\HttpClient;

class SynoCintExtension extends ConfigurableExtension
{
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../../config'));
        $loader->load('services.yml');

        $connect = $mergedConfig['connect'] ?? [];
        if (!empty($connect['account_id']) && !empty($connect['username']) && !empty($connect['password'])) {
            $connectConfigDef = $container->getDefinition(Connect\Client::class);
            $connectConfigDef->setArguments([$container->getDefinition(HttpClient::class), $connect['account_id'], $connect['username'], $connect['password']]);
        } else {

            $connectResources = $container->findTaggedServiceIds('syno.cint.connect_resource');
            foreach (array_keys($connectResources) as $connectResourceId) {
                $container->removeDefinition($connectResourceId);
            }
        }

        $demand = $mergedConfig['demand'] ?? [];
        if (!empty($demand['api_domain']) && !empty($demand['api_key'])) {
            $demandConfigDef = $container->getDefinition(Demand\Client::class);
            $demandConfigDef->setArguments([$container->getDefinition(HttpClient::class), $demand['api_domain'], $demand['api_key']]);
        } else {
            $demandResources = $container->findTaggedServiceIds('syno.cint.demand_resource');
            foreach (array_keys($demandResources) as $demandResourceId) {
                $container->removeDefinition($demandResourceId);
            }
        }
    }
}
