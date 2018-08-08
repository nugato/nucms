<?php

/*
 * This file is part of the NuCms package.
 *
 * (c) Jacek Bednarek
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface SettingsTranslationInterface extends ResourceInterface, TranslationInterface
{
    /**
     * @param string $content
     */
    public function setContent(string $content): void;

    /**
     * @return string
     */
    public function getContent(): ?string;
}
