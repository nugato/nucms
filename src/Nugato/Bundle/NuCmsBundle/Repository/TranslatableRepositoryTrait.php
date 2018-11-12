<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Repository;

use Doctrine\ORM\QueryBuilder;

trait TranslatableRepositoryTrait
{
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
