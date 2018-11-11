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

namespace Nugato\Bundle\NuCmsBundle\Component\Blog\Repository;

use Doctrine\ORM\QueryBuilder;
use Nugato\Bundle\NuCmsBundle\Component\Blog\Entity\PostInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function createListQueryBuilder(string $locale): QueryBuilder;

    public function findBySlug(string $slug, string $locale): ?PostInterface;

    public function findAllByTaxon(TaxonInterface $taxon, string $locale, int $limit = 10, int $page = 1): iterable;
}
