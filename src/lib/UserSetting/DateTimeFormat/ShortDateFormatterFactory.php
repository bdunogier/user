<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\User\UserSetting\DateTimeFormat;

use Ibexa\User\UserSetting\Setting\DateTimeFormatSerializer;
use Ibexa\User\UserSetting\UserSettingService;

class ShortDateFormatterFactory extends AbstractDateTimeFormatterFactory implements DateTimeFormatterFactoryInterface
{
    /** @var \EzSystems\EzPlatformUser\UserSetting\Setting\DateTimeFormatSerializer */
    private $dateTimeFormatSerializer;

    /**
     * @param \EzSystems\EzPlatformUser\UserSetting\UserSettingService $userSettingService
     * @param \EzSystems\EzPlatformUser\UserSetting\Setting\DateTimeFormatSerializer $dateTimeFormatSerializer
     */
    public function __construct(
        UserSettingService $userSettingService,
        DateTimeFormatSerializer $dateTimeFormatSerializer
    ) {
        parent::__construct($userSettingService);
        $this->dateTimeFormatSerializer = $dateTimeFormatSerializer;
    }

    /**
     * {@inheritdoc}
     */
    protected function getFormat(): string
    {
        return (string)$this->dateTimeFormatSerializer->deserialize(
            $this->userSettingService->getUserSetting('short_datetime_format')->value
        )->getDateFormat();
    }
}

class_alias(ShortDateFormatterFactory::class, 'EzSystems\EzPlatformUser\UserSetting\DateTimeFormat\ShortDateFormatterFactory');
