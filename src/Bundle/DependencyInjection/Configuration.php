<?php

namespace Syno\Cint\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('syno_cint');

        $treeBuilder->getRootNode()
            ->children()
                // Connect
                ->arrayNode('connect')
                    ->children()
                        ->variableNode('account_id')->end()
                        ->variableNode('username')->end()
                        ->variableNode('password')->end()
                    ->end()
                ->end()
                // End Connect

                // Demand
                ->arrayNode('demand')
                    ->children()
                        ->variableNode('api_domain')->end()
                        ->variableNode('api_key')->end()
                    ->end()
                ->end()
                // End Demand
            ->end()
        ;

        return $treeBuilder;
    }
}
