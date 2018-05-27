<?php

namespace spec\Nugato\Bundle\NuCmsBundle\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Nugato\Bundle\NuCmsBundle\Fixture\LocaleFixture;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * @mixin LocaleFixture
 */
class LocaleFixtureSpec extends ObjectBehavior
{
    function let(FactoryInterface $localeFactory, ObjectManager $localeManager)
    {
        $this->beConstructedWith($localeFactory, $localeManager, 'pl_PL');
    }

    function it_is_a_fixture(): void
    {
        $this->shouldImplement(FixtureInterface::class);
        $this->shouldHaveType(AbstractFixture::class);
    }

    function it_creates_and_persist_only_base_locale(
        FactoryInterface $localeFactory,
        ObjectManager $localeManager,
        LocaleInterface $locale
    ) {
        $localeFactory->createNew()->willReturn($locale);

        $localeFactory->createNew()->shouldBeCalled();
        $locale->setCode('pl_PL')->shouldBeCalled();
        $localeManager->persist($locale)->shouldBeCalled();

        $localeManager->flush()->shouldBeCalled();

        $this->load([]);
    }

    function it_creates_and_persist_a_locales_with_base_locale(
        FactoryInterface $localeFactory,
        ObjectManager $localeManager,
        LocaleInterface $locale
    ) {
        $options = ['locales' => ['pl_PL', 'en_US']];
        $localeFactory->createNew()->willReturn($locale);

        $localeFactory->createNew()->shouldBeCalled();
        $locale->setCode('pl_PL')->shouldBeCalled();
        $localeManager->persist($locale)->shouldBeCalled();

        $localeFactory->createNew()->shouldBeCalled();
        $locale->setCode('en_US')->shouldBeCalled();
        $localeManager->persist($locale)->shouldBeCalled();

        $localeManager->flush()->shouldBeCalled();

        $this->load($options);
    }
}
