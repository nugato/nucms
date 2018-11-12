<?php
declare(strict_types=1);

namespace Nugato\Bundle\NuCmsBundle\Component\Taxon\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Nugato\Bundle\NuCmsBundle\Component\Taxon\Entity\TaxonInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class TaxonFixture extends AbstractFixture
{
    /**
     * @var FactoryInterface
     */
    private $taxonFactory;

    /**
     * @var FactoryInterface
     */
    private $taxonTranslationFactory;

    /**
     * @var ObjectManager
     */
    private $taxonManager;

    public function __construct(
        FactoryInterface $taxonFactory,
        FactoryInterface $taxonTranslationFactory,
        ObjectManager $taxonManager
    ) {
        $this->taxonFactory = $taxonFactory;
        $this->taxonTranslationFactory = $taxonTranslationFactory;
        $this->taxonManager = $taxonManager;
    }

    public function load(array $options): void
    {
        $taxons = $options['custom'] ?? [];

        foreach ($taxons as $taxonData) {
            $taxon = $this->createTaxon($taxonData);

            $this->taxonManager->persist($taxon);
        }

        $this->taxonManager->flush();
    }


    private function createTaxon(array $data): TaxonInterface
    {
        /** @var TaxonInterface $taxon */
        $taxon = $this->taxonFactory->createNew();

        $taxon->setCode($data['code']);

        foreach ($data['translations'] as $locale => $translationData) {
            /** @var TaxonTranslationInterface $translation */
            $translation = $this->taxonTranslationFactory->createNew();

            $translation->setLocale($locale);
            $translation->setName($translationData['name']);
            $translation->setSlug($translationData['slug']);

            if (isset($translationData['description'])) {
                $translation->setDescription($translationData['description']);
            }

            $taxon->addTranslation($translation);
        }

        if (isset($data['children'])) {
            foreach ($data['children'] as $childOptions) {
                $taxon->addChild($this->createTaxon($childOptions));
            }
        }

        return $taxon;
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
                                        ->scalarNode('name')->cannotBeEmpty()->end()
                                        ->scalarNode('slug')->cannotBeEmpty()->end()
                                        ->scalarNode('description')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->variableNode('children')->cannotBeEmpty()->defaultValue([])->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    public function getName(): string
    {
        return 'taxon';
    }
}
