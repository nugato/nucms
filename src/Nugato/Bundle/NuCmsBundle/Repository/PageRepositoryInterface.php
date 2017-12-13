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

use Doctrine\ORM\QueryBuilder;
use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;

interface PageRepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder(string $locale): QueryBuilder;

    /**
     * @param string $slug
     * @param string $locale
     *
     * @return PageInterface|null
     */
    public function findBySlug(string $slug, string $locale): ?PageInterface;
}
