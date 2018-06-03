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
use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItemInterface;
use Nugato\Bundle\NuCmsBundle\Entity\Navigation\NavigationItemTranslationInterface;
use Nugato\Bundle\NuCmsBundle\Repository\Navigation\NavigationRepositoryInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class NavigationItemFixture extends AbstractFixture implements FixtureInterface
{
    /**
     * @var FactoryInterface
     */
    private $navigationItemFactory;

    /**
     * @var FactoryInterface
     */
    private $navigationItemTranslationFactory;

    /**
     * @var NavigationRepositoryInterface
     */
    private $navigationRepository;

    /**
     * @var ObjectManager
     */
    private $navigationItemManager;

    public function __construct(
        FactoryInterface $navigationItemFactory,
        FactoryInterface $navigationItemTranslationFactory,
        NavigationRepositoryInterface $navigationRepository,
        ObjectManager $navigationItemManager
    ) {
        $this->navigationItemFactory = $navigationItemFactory;
        $this->navigationItemTranslationFactory = $navigationItemTranslationFactory;
        $this->navigationRepository = $navigationRepository;
        $this->navigationItemManager = $navigationItemManager;
    }

    public function load(array $options): void
    {
        $items = (isset($options['custom'])) ? $options['custom'] : [];

        foreach ($items as $item) {
            $item = $this->createItem($item);

            $this->navigationItemManager->persist($item);
        }

        $this->navigationItemManager->flush();
    }

    private function createItem(array $itemData): NavigationItemInterface
    {
        /** @var NavigationItemInterface $item */
        $item = $this->navigationItemFactory->createNew();

        $navigation = $this->navigationRepository->findOneBy(['code' => $itemData['navigation']]);
        if ($navigation) {
            $item->setNavigation($navigation);
        }

        foreach ($itemData['translations'] as $locale => $translationData) {
            /** @var NavigationItemTranslationInterface $itemTranslation */
            $itemTranslation = $this->navigationItemTranslationFactory->createNew();

            $itemTranslation->setLocale($locale);
            $itemTranslation->setName($translationData['name']);
            $itemTranslation->setUrl($translationData['url']);

            $item->addTranslation($itemTranslation);
        }

        if (isset($itemData['children'])) {
            foreach ($itemData['children'] as $childOptions) {
                $item->addChild($this->createItem($childOptions));
            }
        }

        return $item;
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('custom')->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('navigation')->cannotBeEmpty()->end()
                            ->arrayNode('translations')
                                ->arrayPrototype()
                                    ->children()
                                        ->scalarNode('name')->cannotBeEmpty()->end()
                                        ->scalarNode('url')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->variableNode('children')->cannotBeEmpty()->defaultValue([])->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    public function getName(): string
    {
        return 'navigation_item';
    }
}
