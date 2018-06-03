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

namespace spec\Nugato\Bundle\NuCmsBundle\Context;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Context\LocaleNotFoundException;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestBasedWithDefaultLocaleContextSpec extends ObjectBehavior
{
    function let(RequestStack $requestStack, LocaleProviderInterface $localeProvider): void
    {
        $this->beConstructedWith($requestStack, $localeProvider);
    }

    function it_implements_a_locale_context_interface(): void
    {
        $this->shouldHaveType(LocaleContextInterface::class);
    }

    function it_throws_locale_not_found_exception_if_current_request_is_not_found(RequestStack $requestStack): void
    {
        $requestStack->getCurrentRequest()->willReturn(null);

        $this->shouldThrow(LocaleNotFoundException::class)->during('getLocaleCode');
    }

    function it_throws_locale_not_found_exception_if_locale_code_is_not_among_available_ones(
        RequestStack $requestStack,
        LocaleProviderInterface $localeProvider,
        Request $request
    ): void {
        $request->attributes = new ParameterBag(['_locale' => 'en_US']);
        $requestStack->getCurrentRequest()->willReturn($request);
        $localeProvider->getAvailableLocalesCodes()->willReturn(['pl_PL', 'de_DE']);

        $this->shouldThrow(LocaleNotFoundException::class)->during('getLocaleCode');
    }

    function it_returns_default_locale_for_request_without_defined_locale(
        RequestStack $requestStack,
        Request $request,
        LocaleProviderInterface $localeProvider
    ): void {
        $request->attributes = new ParameterBag();
        $request->getDefaultLocale()->willReturn('en_US');
        $requestStack->getCurrentRequest()->willReturn($request);
        $localeProvider->getAvailableLocalesCodes()->willReturn(['en_US', 'pl_PL']);

        $this->getLocaleCode()->shouldBeEqualTo('en_US');
    }

    function it_returns_locale_specified_in_request(
        RequestStack $requestStack,
        Request $request,
        LocaleProviderInterface $localeProvider
    ): void {
        $request->attributes = new ParameterBag(['_locale' => 'en_US']);
        $requestStack->getCurrentRequest()->willReturn($request);
        $localeProvider->getAvailableLocalesCodes()->willReturn(['en_US', 'pl_PL']);

        $this->getLocaleCode()->shouldBeEqualTo('en_US');
    }
}
