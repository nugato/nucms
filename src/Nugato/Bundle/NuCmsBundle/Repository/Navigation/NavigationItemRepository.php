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

namespace Nugato\Bundle\NuCmsBundle\Repository\Navigation;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Tree\RepositoryUtils;
use Gedmo\Tree\TreeListener;
use Nugato\Bundle\NuCmsBundle\Repository\TranslatableEntityRepository;

class NavigationItemRepository extends TranslatableEntityRepository implements NavigationItemRepositoryInterface
{
    /**
     * @var RepositoryUtils
     */
    private $repoUtils;

    /**
     * @var TreeListener
     */
    protected $listener;

    public function __construct(EntityManagerInterface $em, ClassMetadata $class, TreeListener $listener = null)
    {
        parent::__construct($em, $class);

        $this->repoUtils = new RepositoryUtils($this->_em, $this->getClassMetadata(), $listener, $this);
    }

    /**
     * {@inheritdoc}
     */
    public function getTreeByNavigationAndLocale(string $navigationId, string $locale): array
    {
        $queryBuilder = $this->createQueryBuilderWithTranslation($locale);
        $queryBuilder
            ->orderBy('o.root, o.left', 'ASC')
            ->where('o.navigation = :navigation')
            ->setParameter('navigation', (int)$navigationId);

        $items = $queryBuilder->getQuery()->getArrayResult();

        foreach ($items as &$item) {
            $item = $this->prepareItem($item);
        }

        return $this->buildTree($items, []);
    }

    /**
     * {@inheritdoc}
     */
    private function prepareItem(array $item): array
    {
        $translation = reset($item['translations']);
        unset($item['translations']);

        foreach ($translation as $key => $value) {
            if (!isset($item[$key])) {
                $item[$key] = $value;
            }
        }

        return $item;
    }

    /**
     * {@inheritdoc}
     */
    public function createPaginator(array $criteria = [], array $sorting = []): iterable
    {
        [];
    }

    /**
     * @param array $nodes
     * @param array $options
     *
     * @return array|string
     */
    public function buildTree(array $nodes, array $options = array())
    {
        return $this->repoUtils->buildTree($nodes, $options);
    }

    /**
     * @param array $nodes
     *
     * @return array
     */
    public function buildTreeArray(array $nodes)
    {
        return $this->repoUtils->buildTreeArray($nodes);
    }
}
