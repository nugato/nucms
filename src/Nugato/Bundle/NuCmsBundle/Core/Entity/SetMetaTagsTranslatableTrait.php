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

namespace Nugato\Bundle\NuCmsBundle\Core\Entity;

trait SetMetaTagsTranslatableTrait
{
    /**
     * @var string
     */
    protected $metaTitle;

    /**
     * @var string
     */
    protected $metaDescription;

    public function getMetaTitle(): ?string
    {
        return $this->getTranslation()->getMetaTitle();
    }

    public function setMetaTitle(string $metaTitle): void
    {
        $this->getTranslation()->setMetaTitle($metaTitle);
    }

    public function getMetaDescription(): ?string
    {
        return $this->getTranslation()->getMetaDescription();
    }

    public function setMetaDescription(string $metaDescription): void
    {
        $this->getTranslation()->setMetaDescription($metaDescription);
    }
}
