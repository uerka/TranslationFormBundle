<?php

namespace Uerka\TranslationFormBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Uerka\TranslationFormBundle\Form\Type\TranslationsType;
use Symfony\Component\DependencyInjection\Definition;

class UerkaTranslationFormExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = new Definition(TranslationsType::class);
        $definition->addArgument($config['locales']);

        $container->setDefinition(TranslationsType::class, $definition);
    }
}
