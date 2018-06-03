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

use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;
use Nugato\Bundle\NuCmsBundle\Repository\PageRepositoryInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * @param LocaleContextInterface $localeContext
     */
    public function __construct(LocaleContextInterface $localeContext, PageRepositoryInterface $pageRepository)
    {
        $this->localeContext = $localeContext;
        $this->pageRepository = $pageRepository;
    }

    /**
     * @return Response
     */
    public function homePageAction(): Response
    {
        return $this->render('@NugatoNuCms/Web/index.html.twig');
    }

    /**
     * @param string $slug
     *
     * @return Response
     */
    public function singlePageAction(string $slug)
    {
        /** @var PageInterface $page */
        $page = $this->pageRepository->findBySlug($slug, $this->localeContext->getLocaleCode());

        if (!$page) {
            throw new NotFoundHttpException();
        }

        $page->setCurrentLocale($this->localeContext->getLocaleCode());

        return $this->render('@NugatoNuCms/Web/page.html.twig', [
            'page' => $page,
        ]);
    }
}
