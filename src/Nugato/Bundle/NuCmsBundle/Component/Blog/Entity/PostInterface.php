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

use Nugato\Bundle\NuCmsBundle\Core\Entity\SeoMetatagsInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

interface PostInterface extends ResourceInterface, TranslatableInterface, TimestampableInterface, CodeAwareInterface, SlugAwareInterface, SeoMetatagsInterface
{
    public function setTitle(string $title): void;

    public function getTitle(): ?string;

    public function setContent(string $content): void;

    public function getContent(): ?string;

    public function setMainTaxon(TaxonInterface $taxon): void;

    public function getMainTaxon(): ?TaxonInterface;
}
