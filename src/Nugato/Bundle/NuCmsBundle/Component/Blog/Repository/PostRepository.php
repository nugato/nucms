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

use Nugato\Bundle\NuCmsBundle\Component\Blog\Entity\PostInterface;
use Nugato\Bundle\NuCmsBundle\Repository\TranslatableEntityRepository;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

class PostRepository extends TranslatableEntityRepository implements PostRepositoryInterface
{
    public function findBySlug(string $slug, string $locale): ?PostInterface
    {
        $queryBuilder = $this->createQueryBuilderWithTranslation($locale);
        $queryBuilder
            ->where('translation.slug = :slug')
            ->setParameter('slug', $slug);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @param TaxonInterface $taxon
     * @param string $locale
     * @param int $limit
     * @param int $page
     *
     * @return iterable
     */
    public function findAllByTaxon(TaxonInterface $taxon, string $locale, int $limit = 10, int $page = 1): iterable
    {
        $queryBuilder = $this->createQueryBuilderWithTranslation($locale);
        $queryBuilder
            ->innerJoin('o.taxons', 'taxons')
            ->andWhere('taxons = :taxon')
            ->setParameter('taxon', $taxon)
            ->orderBy('o.createdAt', 'ASC');

        $paginator = $this->getPaginator($queryBuilder);
        $paginator->setMaxPerPage($limit);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}
