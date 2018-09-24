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

namespace Nugato\Bundle\NuCmsBundle\Context;

use Sylius\Component\Locale\Context\LocaleNotFoundException;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestBasedWithDefaultLocaleContext implements WebLocaleContextInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var LocaleProviderInterface
     */
    private $localeProvider;

    /**
     * @param RequestStack $requestStack
     * @param LocaleProviderInterface $localeProvider
     */
    public function __construct(RequestStack $requestStack, LocaleProviderInterface $localeProvider)
    {
        $this->requestStack = $requestStack;
        $this->localeProvider = $localeProvider;
    }

    /**
     * @return string
     *
     * @throws LocaleNotFoundException
     */
    public function getLocaleCode(): string
    {
        $request = $this->requestStack->getCurrentRequest();

        if (null === $request) {
            throw new LocaleNotFoundException('No request available.');
        }

        $localeCode = $request->attributes->get('_locale') ?: $request->getDefaultLocale();

        $availableLocalesCodes = $this->localeProvider->getAvailableLocalesCodes();
        if (!\in_array($localeCode, $availableLocalesCodes, true)) {
            throw LocaleNotFoundException::notAvailable($localeCode, $availableLocalesCodes);
        }

        return $localeCode;
    }
}
