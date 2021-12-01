<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\User\Form\Type\UserSettings;

use Ibexa\Core\MVC\ConfigResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FullDateTimeFormatType extends AbstractType
{
    /** @var \Ibexa\Core\MVC\ConfigResolverInterface */
    private $configResolver;

    public function __construct(ConfigResolverInterface $configResolver)
    {
        $this->configResolver = $configResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'date_format_choices' => $this->configResolver->getParameter('user_preferences.allowed_full_date_formats'),
            'time_format_choices' => $this->configResolver->getParameter('user_preferences.allowed_full_time_formats'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return DateTimeFormatType::class;
    }
}

class_alias(FullDateTimeFormatType::class, 'EzSystems\EzPlatformUser\Form\Type\UserSettings\FullDateTimeFormatType');
