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
     * @param LocaleContextInterface $localeContext
     */
    public function __construct(LocaleContextInterface $localeContext)
    {
        $this->localeContext = $localeContext;
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
        $pageRepository = $this->get('nucms.repository.page');
        $page = $pageRepository->findBySlug($slug, $this->localeContext->getLocaleCode());

        if (!$page) {
            throw new NotFoundHttpException();
        }

        return $this->render('@NugatoNuCms/Web/page.html.twig', [
            'page' => $page,
        ]);
    }
}
