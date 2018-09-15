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

namespace Nugato\Bundle\NuCmsBundle\Component\Settings\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Nugato\Bundle\NuCmsBundle\Component\Settings\Entity\SettingsInterface;
use Nugato\Bundle\NuCmsBundle\Component\Settings\Entity\SettingsTranslationInterface;
use Nugato\Bundle\NuCmsBundle\Component\Settings\ValueObject\SettingsType;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class SettingsFixture extends AbstractFixture implements FixtureInterface
{
    /**
     * @var FactoryInterface
     */
    private $settingsFactory;

    /**
     * @var FactoryInterface
     */
    private $settingsTranslationsFactory;

    /**
     * @var ObjectManager
     */
    private $settingsManager;

    public function __construct(
        FactoryInterface $settingsFactory,
        FactoryInterface $settingsTranslationsFactory,
        ObjectManager $settingsManager
    ) {
        $this->settingsFactory = $settingsFactory;
        $this->settingsTranslationsFactory = $settingsTranslationsFactory;
        $this->settingsManager = $settingsManager;
    }

    public function load(array $options): void
    {
        $settings = (isset($options['custom'])) ? $options['custom'] : [];

        foreach ($settings as $settingsData) {
            $setting = $this->createSettings($settingsData);

            $this->settingsManager->persist($setting);
        }

        $this->settingsManager->flush();
    }

    private function createSettings(array $data): SettingsInterface
    {
        /** @var SettingsInterface $settings */
        $settings = $this->settingsFactory->createNew();

        $settings->setCode($data['code']);
        $settings->setType(new SettingsType($data['type']));

        foreach ($data['translations'] as $locale => $translationData) {
            /** @var SettingsTranslationInterface $translation */
            $translation = $this->settingsTranslationsFactory->createNew();

            $translation->setLocale($locale);
            $translation->setContent($translationData['content']);

            $settings->addTranslation($translation);
        }

        return $settings;
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->arrayNode('custom')->requiresAtLeastOneElement()
            ->arrayPrototype()
            ->children()
            ->scalarNode('code')->cannotBeEmpty()->end()
            ->scalarNode('type')->cannotBeEmpty()->end()
            ->arrayNode('translations')
            ->arrayPrototype()
            ->children()
            ->scalarNode('content')->cannotBeEmpty()->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'settings';
    }
}
