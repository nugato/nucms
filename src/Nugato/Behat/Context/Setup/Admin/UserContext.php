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

namespace Nugato\Behat\Context\Setup\Admin;

use Behat\Behat\Context\Context;
use Nugato\Bundle\NuCmsBundle\Entity\User\UserInterface;
use Sylius\Bundle\UserBundle\Doctrine\ORM\UserRepository;
use Sylius\Component\Resource\Factory\Factory;

class UserContext implements Context
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var Factory
     */
    private $userFactory;

    /**
     * @param Factory $userFactory
     * @param UserRepository $userRepository
     */
    public function __construct(Factory $userFactory, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * @Given There is an administrator user :email identified by :password
     */
    public function thereIsAnAdministratorUserIdentifiedBy($email, $password)
    {
        /** @var UserInterface $adminUser */
        $adminUser = $this->userFactory->createNew();

        $adminUser->setUsername($email);
        $adminUser->setUsernameCanonical($email);
        $adminUser->setEmail($email);
        $adminUser->setEmailCanonical($email);
        $adminUser->setPlainPassword($password);
        $adminUser->setLocaleCode('pl_PL');
        $adminUser->setEnabled(true);

        $this->userRepository->add($adminUser);
    }
}
