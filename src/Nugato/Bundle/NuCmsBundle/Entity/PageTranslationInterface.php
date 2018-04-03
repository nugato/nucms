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

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface PageTranslationInterface extends SlugAwareInterface, ResourceInterface, TranslationInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int;

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): ?string;

    /**
     * Set content
     *
     * @param string $content
     */
    public function setContent(string $content): void;

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string;
}
