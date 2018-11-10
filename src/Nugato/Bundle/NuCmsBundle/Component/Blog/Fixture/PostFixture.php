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

namespace Nugato\Bundle\NuCmsBundle\Component\Blog\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Nugato\Bundle\NuCmsBundle\Component\Blog\Entity\PostInterface;
use Nugato\Bundle\NuCmsBundle\Component\Blog\Entity\PostTranslationInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PostFixture extends AbstractFixture
{
    /**
     * @var FactoryInterface
     */
    private $postFactory;

    /**
     * @var FactoryInterface
     */
    private $postTranslationFactory;

    /**
     * @var ObjectManager
     */
    private $postManager;

    public function __construct(
        FactoryInterface $postFactory,
        FactoryInterface $postTranslationFactory,
        ObjectManager $postManager
    ) {
        $this->postFactory = $postFactory;
        $this->postTranslationFactory = $postTranslationFactory;
        $this->postManager = $postManager;
    }

    public function load(array $options): void
    {
        $post = $options['custom'] ?? [];

        foreach ($post as $postData) {
            $post = $this->createPost($postData);

            $this->postManager->persist($post);
        }

        $this->postManager->flush();
    }

    private function createPost(array $data): PostInterface
    {
        /** @var PostInterface $post */
        $post = $this->postFactory->createNew();

        $post->setCode($data['code']);

        foreach ($data['translations'] as $locale => $translationData) {
            /** @var PostTranslationInterface $translation */
            $translation = $this->postTranslationFactory->createNew();

            $translation->setLocale($locale);
            $translation->setTitle($translationData['title']);
            $translation->setSlug($translationData['slug']);

            if (isset($translationData['content'])) {
                $translation->setContent($translationData['content']);
            }
            if (isset($translationData['meta_title'])) {
                $translation->setMetaTitle($translationData['meta_title']);
            }
            if (isset($translationData['meta_description'])) {
                $translation->setMetaDescription($translationData['meta_description']);
            }

            $post->addTranslation($translation);
        }

        return $post;
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
                                        ->scalarNode('meta_title')->end()
                                        ->scalarNode('meta_description')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    public function getName(): string
    {
        return 'blog_post';
    }
}
