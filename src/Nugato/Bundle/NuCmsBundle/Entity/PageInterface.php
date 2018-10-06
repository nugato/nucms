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

namespace Nugato\Bundle\NuCmsBundle\Entity;

use Nugato\Bundle\NuCmsBundle\Core\Entity\SetMetatagsInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface PageInterface extends SlugAwareInterface, ResourceInterface, TranslatableInterface, CodeAwareInterface, SetMetatagsInterface
{
    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return string
     */
    public function getTitle(): ?string;

    /**
     * @param string $content
     */
    public function setContent(string $content): void;

    /**
     * @return string
     */
    public function getContent(): ?string;

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface;

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface;

    /**
     * @param string $template
     */
    public function setTemplate(string $template): void;

    /**
     * @return string
     */
    public function getTemplate(): ?string;

    /**
     * @return bool
     */
    public function hasTemplateSelected(): bool;
}
