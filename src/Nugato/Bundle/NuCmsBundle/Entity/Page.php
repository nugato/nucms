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
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;

class Page implements ResourceInterface, TranslatableInterface, PageInterface
{
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var int
     */
    private $id;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->getTranslation()->getTitle();
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->getTranslation()->setTitle($title);
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->getTranslation()->getContent();
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->getTranslation()->setContent($content);
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): PageTranslation
    {
        return new PageTranslation();
    }
}
