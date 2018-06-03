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

namespace Nugato\Bundle\NuCmsBundle\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class LocaleFixture extends AbstractFixture implements FixtureInterface
{
    /**
     * @var FactoryInterface
     */
    private $localeFactory;

    /**
     * @var ObjectManager
     */
    private $localeManager;

    /**
     * @var string
     */
    private $baseLocaleCode;

    public function __construct(FactoryInterface $localeFactory, ObjectManager $localeManager, string $baseLocaleCode)
    {
        $this->localeFactory = $localeFactory;
        $this->localeManager = $localeManager;
        $this->baseLocaleCode = $baseLocaleCode;
    }

    public function load(array $options): void
    {
        $options['locales'] = isset($options['locales']) ? $options['locales'] : [];
        $localesCodes = array_merge([$this->baseLocaleCode], $options['locales']);

        foreach ($localesCodes as $localeCode) {
            /** @var LocaleInterface $locale */
            $locale = $this->localeFactory->createNew();
            $locale->setCode($localeCode);
            $this->localeManager->persist($locale);
        }

        $this->localeManager->flush();
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('locales')
                    ->scalarPrototype();
    }

    public function getName(): string
    {
        return 'locale';
    }
}
