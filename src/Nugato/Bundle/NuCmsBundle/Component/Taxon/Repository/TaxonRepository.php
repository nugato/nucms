<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Component\Taxon\Repository;

use Nugato\Bundle\NuCmsBundle\Repository\TranslatableRepositoryTrait;
use Sylius\Bundle\TaxonomyBundle\Doctrine\ORM\TaxonRepository as BaseTaxonRepository;

class TaxonRepository extends BaseTaxonRepository implements TaxonRepositoryInterface
{
    use TranslatableRepositoryTrait;

    /**
     * {@inheritdoc}
     */
    public function findAllByParentCode(
        string $parentCode,
        ?string $locale = null,
        int $limit = 10,
        int $page = 1
    ): iterable {
        $queryBuilder = $this->createQueryBuilderWithTranslation($locale)
            ->addSelect('child')
            ->innerJoin('o.parent', 'parent')
            ->leftJoin('o.children', 'child')
            ->andWhere('parent.code = :parentCode')
            ->addOrderBy('o.position')
            ->setParameter('parentCode', $parentCode);

        $paginator = $this->getPaginator($queryBuilder);
        $paginator->setMaxPerPage($limit);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}
