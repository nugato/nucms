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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Nugato\Bundle\NuCmsBundle\Core\Entity\SeoMetaTagsTranslatableTrait;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

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

    /**
     * @var TaxonInterface|null
     */
    protected $mainTaxon;

    /**
     * @var Collection|TaxonInterface[]
     */
    protected $taxons;

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->taxons = new ArrayCollection();
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

    public function setMainTaxon(TaxonInterface $mainTaxon): void
    {
        $this->mainTaxon = $mainTaxon;
    }

    public function getMainTaxon(): ?TaxonInterface
    {
        return $this->mainTaxon;
    }

    public function getTaxons(): Collection
    {
        return $this->taxons;
    }

    public function addTaxon(TaxonInterface $taxon): void
    {
        if (!$this->hasTaxon($taxon)) {
            $this->taxons->add($taxon);
        }
    }

    public function removeTaxon(TaxonInterface $taxon): void
    {
        if ($this->hasTaxon($taxon)) {
            $this->taxons->removeElement($taxon);
        }
    }

    public function hasTaxon(TaxonInterface $taxon): bool
    {
        return $this->taxons->contains($taxon);
    }

    protected function createTranslation(): PostTranslation
    {
        return new PostTranslation();
    }
}
