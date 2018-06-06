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

namespace Nugato\Bundle\NuCmsBundle\Repository;

use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;

class PageRepository extends TranslatableEntityRepository implements PageRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findBySlug(string $slug, string $locale): ?PageInterface
    {
        $queryBuilder = $this->createQueryBuilderWithTranslation($locale);
        $queryBuilder
            ->where('translation.slug = :slug')
            ->setParameter('slug', $slug);

        return $queryBuilder->getQuery()->getSingleResult();
    }
}
