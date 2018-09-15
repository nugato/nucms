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

use Nugato\Bundle\NuCmsBundle\Component\Settings\Repository\SettingsRepositoryInterface;
use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;
use Nugato\Bundle\NuCmsBundle\Repository\PageRepositoryInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var LocaleProviderInterface
     */
    private $localeProvider;

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * @var SettingsRepositoryInterface
     */
    private $settingsRepository;

    public function __construct(
        LocaleContextInterface $localeContext,
        LocaleProviderInterface $localeProvider,
        PageRepositoryInterface $pageRepository,
        SettingsRepositoryInterface $settingsRepository
    ) {
        $this->localeContext = $localeContext;
        $this->localeProvider = $localeProvider;
        $this->pageRepository = $pageRepository;
        $this->settingsRepository = $settingsRepository;
    }

    public function homePage(Request $request): Response
    {
        $defaultLocale = $this->localeProvider->getDefaultLocaleCode();

        if ($request->getPathInfo() === '/'.$defaultLocale.'/') {
            return $this->redirectToRoute('nucms_web_homepage');
        }

        return $this->render(
            '@NugatoNuCms/Web/index.html.twig',
            [
                'settings' => $this->getSettings(),
            ]
        );
    }

    public function singlePage(string $slug): Response
    {
        /** @var PageInterface $page */
        $page = $this->pageRepository->findBySlug($slug, $this->localeContext->getLocaleCode());

        if (!$page) {
            throw new NotFoundHttpException();
        }

        $page->setCurrentLocale($this->localeContext->getLocaleCode());

        return $this->render(
            '@NugatoNuCms/Web/page.html.twig',
            [
                'page' => $page,
                'settings' => $this->getSettings(),
            ]
        );
    }

    private function getSettings(): array
    {
        return $this->settingsRepository->findAllByLocale($this->localeContext->getLocaleCode());
    }
}
