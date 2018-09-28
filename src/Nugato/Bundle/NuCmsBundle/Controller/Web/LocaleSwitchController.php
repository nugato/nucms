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

use Nugato\Bundle\NuCmsBundle\Context\WebLocaleContextInterface;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LocaleSwitchController extends Controller
{
    /**
     * @var WebLocaleContextInterface
     */
    private $localeContext;

    /**
     * @var LocaleProviderInterface
     */
    private $localeProvider;

    public function __construct(WebLocaleContextInterface $localeContext, LocaleProviderInterface $localeProvider)
    {
        $this->localeContext = $localeContext;
        $this->localeProvider = $localeProvider;
    }

    public function renderSwitch(): Response
    {
        return $this->render(
            '@NugatoNuCms/Web/Navigation/_localeSwitch.html.twig',
            [
                'active' => $this->localeContext->getLocaleCode(),
                'locales' => $this->localeProvider->getAvailableLocalesCodes(),
            ]
        );
    }

    public function switch(?string $code = null): Response
    {
        $defaultLocale = $this->localeProvider->getDefaultLocaleCode();

        if (null === $code) {
            $code = $defaultLocale;
        }

        if (!\in_array($code, $this->localeProvider->getAvailableLocalesCodes(), true)) {
            throw new HttpException(
                Response::HTTP_NOT_ACCEPTABLE,
                sprintf('The locale code "%s" is invalid.', $code)
            );
        }

        if ($code === $defaultLocale) {
            return $this->redirectToRoute('nucms_web_homepage');
        }

        return $this->redirectToRoute('nucms_web_homepage_locale', ['_locale' => $code]);
    }
}
