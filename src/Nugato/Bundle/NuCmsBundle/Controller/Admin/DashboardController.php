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

namespace Nugato\Bundle\NuCmsBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $repo = $this->get('nucms.repository.navigation_item');

//        $rep

//        die();

        $queryBuilder = $repo->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin(
                'o.translations',
                'translation',
                'WITH', 'translation.locale = :locale'
            )
            ->where('o.navigation = :navigation')
            ->setParameter('locale', 'pl_PL')
            ->setParameter('navigation', 28);

        $query = $queryBuilder->getQuery();

//        $tree = $repo->childrenHierarchy();

//        $items = $repo->findBy(['navigation' => 28]);
        $items = $query->getArrayResult();

        dump($items);
//        dump($tree);
//        die();

//        $query = $entityManager
//            ->createQueryBuilder()
//            ->select('node')
//            ->from('Entity\Category', 'node')
//            ->orderBy('node.root, node.lft', 'ASC')
//            ->where('node.root = 1')
//            ->getQuery()
//        ;
        $options = array('decorate' => false);
        $tree = $repo->buildTree($items, $options);
//        $tree = $repo->buildTree($query->getArrayResult(), $options);

        dump($tree);
//        die();
        return $this->render('NugatoNuCmsBundle:Admin/Dashboard:index.html.twig');
    }
}
