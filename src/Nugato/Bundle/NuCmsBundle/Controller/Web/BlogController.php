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

use Nugato\Bundle\NuCmsBundle\Component\Blog\Entity\PostInterface;
use Nugato\Bundle\NuCmsBundle\Component\Blog\Repository\PostRepositoryInterface;
use Nugato\Bundle\NuCmsBundle\Component\Settings\Entity\SettingsInterface;
use Nugato\Bundle\NuCmsBundle\Component\Settings\Repository\SettingsRepositoryInterface;
use Nugato\Bundle\NuCmsBundle\Component\Taxon\Repository\TaxonRepositoryInterface;
use Nugato\Bundle\NuCmsBundle\Context\WebLocaleContextInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends Controller
{
    /**
     * @var WebLocaleContextInterface
     */
    private $localeContext;

    /**
     * @var TaxonRepositoryInterface
     */
    private $taxonRepository;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var SettingsRepositoryInterface
     */
    private $settingsRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(
        WebLocaleContextInterface $localeContext,
        TaxonRepositoryInterface $taxonRepository,
        PostRepositoryInterface $postRepository,
        SettingsRepositoryInterface $settingsRepository,
        SessionInterface $session
    ) {
        $this->localeContext = $localeContext;
        $this->taxonRepository = $taxonRepository;
        $this->postRepository = $postRepository;
        $this->settingsRepository = $settingsRepository;
        $this->session = $session;
    }

    public function posts(Request $request): Response
    {
        $template = $request->attributes->get('template', '@NugatoNuCms/Web/Blog/posts.html.twig');

        $posts = $this->postRepository->findAllByLocale(
            $this->localeContext->getLocaleCode(),
            (int)$request->query->get('limit', 10),
            (int)$request->query->get('page', 1)
        );

        return $this->render(
            $template,
            [
                'posts' => $posts,
                'settings' => $this->getSettings(),
            ]
        );
    }

    public function postsByTaxon(Request $request, string $slug): Response
    {
        $template = $request->attributes->get('template', '@NugatoNuCms/Web/Blog/postsByTaxon.html.twig');
        $this->session->set('blog_index_slug', $request->getUri());
        $taxon = $this->taxonRepository->findOneBySlug($slug, $this->localeContext->getLocaleCode());
        if (!$taxon) {
            throw new NotFoundHttpException();
        }

        $posts = $this->postRepository->findAllByTaxon(
            $taxon,
            $this->localeContext->getLocaleCode(),
            (int)$request->query->get('limit', 10),
            (int)$request->query->get('page', 1)
        );

        return $this->render(
            $template,
            [
                'taxon' => $taxon,
                'posts' => $posts,
                'settings' => $this->getSettings(),
            ]
        );
    }

    public function postShow(string $slug): Response
    {
        /** @var PostInterface $post */
        $post = $this->postRepository->findBySlug($slug, $this->localeContext->getLocaleCode());
        if (!$post) {
            throw new NotFoundHttpException();
        }

        $returnUri = $this->session->get('blog_index_slug');
        if ($returnUri === null && $post->getMainTaxon()) {
            $returnUri = $this->generateUrl(
                'nucms_web_blog_posts_by_taxon',
                ['slug' => $post->getMainTaxon()->getSlug()]
            );
        }

        $post->setCurrentLocale($this->localeContext->getLocaleCode());

        return $this->render(
            '@NugatoNuCms/Web/Blog/postShow.html.twig',
            [
                'returnUri' => $returnUri,
                'post' => $post,
                'settings' => $this->getSettings(),
            ]
        );
    }

    public function partialLatestPosts(Request $request): Response
    {
        $template = $request->attributes->get('template', '@NugatoNuCms/Web/Blog/Partial/_latestPosts.html.twig');
        $limit = $request->attributes->get('limit', 10);
        $page = $request->attributes->get('page', 1);

        $posts = $this->postRepository->findAllByLocale($this->localeContext->getLocaleCode(), (int)$limit, (int)$page);

        return $this->render(
            $template,
            [
                'posts' => $posts,
                'settings' => $this->getSettings(),
            ]
        );
    }

    public function partialTaxons(Request $request): Response
    {
        $template = $request->attributes->get('template', '@NugatoNuCms/Web/Blog/Partial/_taxons.html.twig');
        $code = $request->attributes->get('code', '');
        $limit = $request->attributes->get('limit', 10);
        $page = $request->attributes->get('page', 1);

        $taxons = $this->taxonRepository->findAllByParentCode(
            $code,
            $this->localeContext->getLocaleCode(),
            $limit,
            $page
        );

        return $this->render(
            $template,
            [
                'taxons' => $taxons,
                'settings' => $this->getSettings(),
            ]
        );
    }

    private function getSettings(): array
    {
        $result = [];
        /** @var SettingsInterface[] $settings */
        $settings = $this->settingsRepository->findAllByLocale($this->localeContext->getLocaleCode());

        foreach ($settings as $setting) {
            $result[$setting->getCode()] = $setting;
        }

        return $result;
    }
}
