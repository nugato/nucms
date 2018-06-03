<?php

namespace spec\Nugato\Bundle\NuCmsBundle\Provider;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;

class TranslationLocaleProviderSpec extends ObjectBehavior
{
    function let(RepositoryInterface $localeRepository): void
    {
        $this->beConstructedWith($localeRepository, 'en_US');
    }

    function it_implements_base_translation_locale_provider()
    {
        $this->shouldImplement(TranslationLocaleProviderInterface::class);
    }

    function it_returns_all_locale_returned_by_repository(
        RepositoryInterface $localeRepository,
        LocaleInterface $locale1,
        LocaleInterface $locale2
    ) {
        $expectedLocales = ['en_US', 'pl_PL'];
        $locale1->getCode()->willReturn($expectedLocales[0]);
        $locale2->getCode()->willReturn($expectedLocales[1]);

        $localeRepository->findAll()->willReturn([$locale1, $locale2]);

        $this->getDefinedLocalesCodes()->shouldReturn($expectedLocales);
    }

    function it_returns_default_locale_sets_in_constructor()
    {
        $this->getDefaultLocaleCode()->shouldReturn('en_US');
    }
}
