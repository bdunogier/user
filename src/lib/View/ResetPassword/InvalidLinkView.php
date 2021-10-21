<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\User\View\ResetPassword;

use eZ\Publish\Core\MVC\Symfony\View\BaseView;

class InvalidLinkView extends BaseView
{
}

class_alias(InvalidLinkView::class, 'EzSystems\EzPlatformUser\View\ResetPassword\InvalidLinkView');
