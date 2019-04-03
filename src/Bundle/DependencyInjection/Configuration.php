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
                ->arrayNode('connect')
                    ->children()
                        ->integerNode('account_id')->end()
                        ->scalarNode('username')->end()
                        ->scalarNode('password')->end()
                    ->end()
                ->end() // Connect
            ->end()
        ;

        return $treeBuilder;
    }
}
