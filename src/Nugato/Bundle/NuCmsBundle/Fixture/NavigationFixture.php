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
use Nugato\Bundle\NuCmsBundle\Component\Navigation\Entity\NavigationInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class NavigationFixture extends AbstractFixture implements FixtureInterface
{
    /**
     * @var FactoryInterface
     */
    private $navigationFactory;

    /**
     * @var ObjectManager
     */
    private $navigationManager;

    public function __construct(
        FactoryInterface $navigationFactory,
        ObjectManager $navigationManager
    ) {
        $this->navigationFactory = $navigationFactory;
        $this->navigationManager = $navigationManager;
    }

    public function load(array $options): void
    {
        $navigations = (isset($options['custom'])) ? $options['custom'] : [];

        foreach ($navigations as $navigationData) {
            /** @var NavigationInterface $navigation */
            $navigation = $this->navigationFactory->createNew();

            $navigation->setName($navigationData['name']);
            $navigation->setCode($navigationData['code']);

            $this->navigationManager->persist($navigation);
        }

        $this->navigationManager->flush();
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('custom')->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('code')->cannotBeEmpty()->end()
                            ->scalarNode('name')->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    public function getName(): string
    {
        return 'navigation';
    }
}
