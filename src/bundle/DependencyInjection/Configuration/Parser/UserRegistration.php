<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\Bundle\User\DependencyInjection\Configuration\Parser;

use Ibexa\Bundle\Core\DependencyInjection\Configuration\AbstractParser;
use Ibexa\Bundle\Core\DependencyInjection\Configuration\SiteAccessAware\ContextualizerInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class UserRegistration extends AbstractParser
{
    /**
     * Adds semantic configuration definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\NodeBuilder $nodeBuilder Node just under ezpublish.system.<siteaccess>
     */
    public function addSemanticConfig(NodeBuilder $nodeBuilder)
    {
        $nodeBuilder
            ->arrayNode('user_registration')
                ->info('User registration configuration')
                ->children()
                    ->scalarNode('group_id')
                        ->info('Content id of the user group where users who register are created.')
                        ->defaultValue(11)
                    ->end()
                    ->arrayNode('templates')
                        ->info('User registration templates.')
                        ->children()
                            ->scalarNode('form')
                                ->info('Template to use for registration form rendering.')
                            ->end()
                            ->scalarNode('confirmation')
                                ->info('Template to use for registration confirmation rendering.')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    public function mapConfig(array &$scopeSettings, $currentScope, ContextualizerInterface $contextualizer)
    {
        if (empty($scopeSettings['user_registration'])) {
            return;
        }

        $settings = $scopeSettings['user_registration'];

        if (!empty($settings['group_id'])) {
            $contextualizer->setContextualParameter(
                'user_registration.group_id',
                $currentScope,
                $settings['group_id']
            );
        }

        if (!empty($settings['templates']['form'])) {
            $contextualizer->setContextualParameter(
                'user_registration.templates.form',
                $currentScope,
                $settings['templates']['form']
            );
        }

        if (!empty($settings['templates']['confirmation'])) {
            $contextualizer->setContextualParameter(
                'user_registration.templates.confirmation',
                $currentScope,
                $settings['templates']['confirmation']
            );
        }
    }
}

class_alias(UserRegistration::class, 'EzSystems\EzPlatformUserBundle\DependencyInjection\Configuration\Parser\UserRegistration');
