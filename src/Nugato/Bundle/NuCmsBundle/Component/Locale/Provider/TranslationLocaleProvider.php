<?php

namespace Nugato\Bundle\NuCmsBundle\Component\Locale\Provider;

use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;

class TranslationLocaleProvider implements TranslationLocaleProviderInterface
{
    /**
     * @var RepositoryInterface
     */
    private $localeRepository;

    /**
     * @var string
     */
    private $defaultLocaleCode;

    /**
     * @param RepositoryInterface $localeRepository
     * @param string $defaultLocaleCode
     */
    public function __construct(RepositoryInterface $localeRepository, string $defaultLocaleCode)
    {
        $this->localeRepository = $localeRepository;
        $this->defaultLocaleCode = $defaultLocaleCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinedLocalesCodes(): array
    {
        $locales = $this->localeRepository->findAll();

        return array_map(
            function (LocaleInterface $locale) {
                return $locale->getCode();
            },
            $locales
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLocaleCode(): string
    {
        return $this->defaultLocaleCode;
    }
}
