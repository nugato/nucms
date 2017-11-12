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

namespace Nugato\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\Factory;

class LocaleContext implements Context
{
    /**
     * @var Factory
     */
    private $localeFactory;

    /**
     * @var EntityRepository
     */
    private $localeRepository;

    /**
     * @param Factory $localeFactory
     * @param EntityRepository $localeRepository
     */
    public function __construct(Factory $localeFactory, EntityRepository $localeRepository)
    {
        $this->localeFactory = $localeFactory;
        $this->localeRepository = $localeRepository;
    }

    /**
     * @Given There are defined locales :locales
     *
     * @param string $locales
     */
    public function thereAreDefinedLocales(string $locales): void
    {
        $localesList = explode(',', $locales);

        foreach ($localesList as $locale) {
            /** @var LocaleInterface $locale */
            $localeEntity = $this->localeFactory->createNew();
            $localeEntity->setCode($locale);

            $this->localeRepository->add($localeEntity);
        }
    }
}
