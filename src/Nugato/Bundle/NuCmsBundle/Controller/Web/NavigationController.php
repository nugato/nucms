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

namespace Nugato\Bundle\NuCmsBundle\Controller\Web;

use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationInterface;
use Nugato\Bundle\NuCmsBundle\Repository\Navigation\NavigationItemRepositoryInterface;
use Nugato\Bundle\NuCmsBundle\Repository\Navigation\NavigationRepositoryInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NavigationController extends Controller
{
    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var NavigationItemRepositoryInterface
     */
    private $navigationItemRepository;

    /**
     * @var NavigationRepositoryInterface
     */
    private $navigationRepository;

    public function __construct(
        LocaleContextInterface $localeContext,
        NavigationRepositoryInterface $navigationRepository,
        NavigationItemRepositoryInterface $navigationItemRepository
    ) {
        $this->localeContext = $localeContext;
        $this->navigationRepository = $navigationRepository;
        $this->navigationItemRepository = $navigationItemRepository;
    }

    public function renderByCode(string $code): Response
    {
        /** @var NavigationInterface $navigation */
        $navigation = $this->navigationRepository->findOneBy(['code' => $code]);
        if (!$navigation) {
            $this->createNotFoundException();
        }

        $navigationItems = $this->navigationItemRepository->getTreeByNavigationAndLocale(
            (string)$navigation->getId(),
            $this->localeContext->getLocaleCode()
        );

        return $this->render(
            '@NugatoNuCms/Web/Navigation/_menu.html.twig',
            [
                'navigation' => $navigation,
                'navigation_items' => $navigationItems,
            ]
        );
    }
}
