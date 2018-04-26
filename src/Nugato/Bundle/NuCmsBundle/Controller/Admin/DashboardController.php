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

use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $itemFactory = $this->get('nucms.factory.navigation_item');
        $localeContext = $this->get('nucms.context.locale.admin_based');

        /** @var NavigationItemInterface $item */
        $item = $itemFactory->createNew();
        $item->setCurrentLocale($localeContext->getLocaleCode());
        $item->setName('Item 1 en');

        $this->getDoctrine()->getManager()->persist($item);
        $this->getDoctrine()->getManager()->flush();

        return $this->render('NugatoNuCmsBundle:Admin/Dashboard:index.html.twig');
    }
}
