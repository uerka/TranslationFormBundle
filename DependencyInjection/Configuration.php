<?php

namespace Uerka\TranslationFormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('uerka_translation_form');
        $rootNode->children()
            ->arrayNode('locales')
                ->isRequired()
                ->requiresAtLeastOneElement()
                ->prototype('scalar')->end()
            ->end();
        return $treeBuilder;
    }

}
