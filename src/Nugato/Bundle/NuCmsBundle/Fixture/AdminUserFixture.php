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
use Nugato\Bundle\NuCmsBundle\Entity\User\UserInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class AdminUserFixture extends AbstractFixture implements FixtureInterface
{
    /**
     * @var FactoryInterface
     */
    private $userFactory;

    /**
     * @var ObjectManager
     */
    private $userManager;

    public function __construct(FactoryInterface $userFactory, ObjectManager $userManager)
    {
        $this->userFactory = $userFactory;
        $this->userManager = $userManager;
    }

    public function load(array $options): void
    {
        $users = (isset($options['custom'])) ? $options['custom'] : [];

        foreach ($users as $userData) {
            $enabled = isset($options['enabled']) ? (bool)$options['enabled'] : true;
            /** @var UserInterface $user */
            $user = $this->userFactory->createNew();

            $user->setEmail($userData['email']);
            $user->setEmailCanonical($userData['email']);
            $user->setUsername($userData['username']);
            $user->setUsernameCanonical($userData['username']);
            $user->setEnabled($enabled);
            $user->setPlainPassword($userData['password']);
            $user->setLocaleCode($userData['locale_code']);
            $user->setFirstName($userData['first_name']);
            $user->setLastName($userData['last_name']);
            $user->addRole(UserInterface::ROLE_ADMIN_ACCESS);

            if (isset($userData['api']) && $userData['api']) {
                $user->addRole(UserInterface::ROLE_API_ACCESS);
            }

            $this->userManager->persist($user);
        }

        $this->userManager->flush();
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('custom')->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('email')->cannotBeEmpty()->end()
                            ->scalarNode('username')->cannotBeEmpty()->end()
                            ->booleanNode('enabled')->end()
                            ->booleanNode('api')->end()
                            ->scalarNode('password')->cannotBeEmpty()->end()
                            ->scalarNode('locale_code')->cannotBeEmpty()->end()
                            ->scalarNode('first_name')->cannotBeEmpty()->end()
                            ->scalarNode('last_name')->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    public function getName(): string
    {
        return 'admin_user';
    }
}
