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

use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;
use Nugato\Bundle\NuCmsBundle\Repository\TranslatableEntityRepository;

class PostRepository extends TranslatableEntityRepository implements PostRepositoryInterface
{
    public function findBySlug(string $slug, string $locale): ?PageInterface
    {
        $queryBuilder = $this->createQueryBuilderWithTranslation($locale);
        $queryBuilder
            ->where('translation.slug = :slug')
            ->setParameter('slug', $slug);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
