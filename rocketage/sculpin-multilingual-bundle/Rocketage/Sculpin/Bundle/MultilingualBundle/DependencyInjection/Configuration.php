<?php

/*
 * This file is a part of Sculpin.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rocketage\Sculpin\Bundle\MultilingualBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('sculpin_multilingual');

        return $treeBuilder;
    }
}
