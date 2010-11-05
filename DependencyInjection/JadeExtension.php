<?php

namespace Bundle\Everzet\JadeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/*
 * This file is part of the EverzetJadeBundle.
 * (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Jade extension for DIC.
 *
 * @author      Konstantin Kudryashov <ever.zet@gmail.com>
 */
class JadeExtension extends Extension
{
    /**
     * Load jade configuration. 
     * 
     * @param   array               $config     configuration parameters
     * @param   ContainerBuilder    $container  service container
     */
    public function configLoad($config, ContainerBuilder $container)
    {
        if (!$container->hasDefinition('jade.class')) {
            $this->loadDefaults($container);
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__ . '/../Resources/config/schema';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getNamespace()
    {
        return 'http://everzet.com/schema/dic/jade';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAlias()
    {
        return 'jade';
    }

    /**
     * @codeCoverageIgnore
     */
    protected function loadDefaults($container)
    {
        $loader = new XmlFileLoader($container, __DIR__ . '/../Resources/config/');
        $loader->load('jade.xml');
    }
}
