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
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class TranslatableEntityRepository extends EntityRepository
{
    /**
     * @param string $locale
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilderWithTranslation($locale);
    }

    /**
     * Create default query builder joining translation by locale
     *
     * @param string $locale
     *
     * @return QueryBuilder
     */
    protected function createQueryBuilderWithTranslation(string $locale): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin(
                'o.translations',
                'translation',
                'WITH',
                'translation.locale = :locale'
            )
            ->setParameter('locale', $locale);

        return $queryBuilder;
    }
}
