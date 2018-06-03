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
use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;
use Nugato\Bundle\NuCmsBundle\Entity\PageTranslationInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PageFixture extends AbstractFixture implements FixtureInterface
{
    /**
     * @var FactoryInterface
     */
    private $pageFactory;

    /**
     * @var FactoryInterface
     */
    private $pageTranslationFactory;

    /**
     * @var ObjectManager
     */
    private $pageManager;

    public function __construct(
        FactoryInterface $pageFactory,
        FactoryInterface $pageTranslationFactory,
        ObjectManager $pageManager
    ) {
        $this->pageFactory = $pageFactory;
        $this->pageTranslationFactory = $pageTranslationFactory;
        $this->pageManager = $pageManager;
    }

    /**
     * @param array $options
     */
    public function load(array $options): void
    {
        $pages = (isset($options['custom'])) ? $options['custom'] : [];

        foreach ($pages as $pageData) {
            $page = $this->createPage($pageData);

            $this->pageManager->persist($page);
        }

        $this->pageManager->flush();
    }

    private function createPage(array $pageData): PageInterface
    {
        /** @var PageInterface $page */
        $page = $this->pageFactory->createNew();

        $page->setCode($pageData['code']);

        foreach ($pageData['translations'] as $locale => $translationData) {
            /** @var PageTranslationInterface $pageTranslation */
            $pageTranslation = $this->pageTranslationFactory->createNew();

            $pageTranslation->setLocale($locale);
            $pageTranslation->setTitle($translationData['title']);
            $pageTranslation->setSlug($translationData['slug']);
            $pageTranslation->setContent($translationData['content']);

            $page->addTranslation($pageTranslation);
        }

        return $page;
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('custom')->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('code')->cannotBeEmpty()->end()
                            ->arrayNode('translations')
                                ->arrayPrototype()
                                    ->children()
                                        ->scalarNode('title')->cannotBeEmpty()->end()
                                        ->scalarNode('slug')->cannotBeEmpty()->end()
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
        return 'page';
    }
}
