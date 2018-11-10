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

namespace Nugato\Bundle\NuCmsBundle\Component\Blog\Entity;

use Nugato\Bundle\NuCmsBundle\Core\Entity\SeoMetaTagsTranslatableTrait;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;

class Post implements PostInterface
{
    use SeoMetaTagsTranslatableTrait;
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->getTranslation()->getTitle();
    }

    public function setTitle(string $title): void
    {
        $this->getTranslation()->setTitle($title);
    }

    public function getContent(): ?string
    {
        return $this->getTranslation()->getContent();
    }

    public function setContent(string $content): void
    {
        $this->getTranslation()->setContent($content);
    }

    public function getSlug(): ?string
    {
        return $this->getTranslation()->getSlug();
    }

    public function setSlug(?string $slug): void
    {
        $this->getTranslation()->setSlug($slug);
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    protected function createTranslation(): PageTranslation
    {
        return new PageTranslation();
    }
}
