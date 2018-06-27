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
use Nugato\Behat\Page\Admin\DashboardPage;
use Nugato\Behat\Page\Admin\LoginPage;
use Nugato\Bundle\NuCmsBundle\Component\User\Entity\UserInterface;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;
use SensioLabs\Behat\PageObjectExtension\PageObject\Exception\UnexpectedPageException;
use Sylius\Bundle\UserBundle\Doctrine\ORM\UserRepository;
use Sylius\Component\Resource\Factory\Factory;
use Webmozart\Assert\Assert;

class UserContext extends PageObjectContext implements Context
{
    /**
     * @var Factory
     */
    private $userFactory;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var LoginPage
     */
    private $loginPage;

    /**
     * @var DashboardPage
     */
    private $dashboardPage;

    /**
     * @param Factory $userFactory
     * @param UserRepository $userRepository
     * @param LoginPage $loginPage
     * @param DashboardPage $dashboardPage
     */
    public function __construct(
        Factory $userFactory,
        UserRepository $userRepository,
        LoginPage $loginPage,
        DashboardPage $dashboardPage
    ) {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
        $this->loginPage = $loginPage;
        $this->dashboardPage = $dashboardPage;
    }

    /**
     * @Given There is an administrator user :email identified by :password
     *
     * @param string $email
     * @param string $password
     */
    public function thereIsAnAdministratorUserIdentifiedBy(string $email, string $password): void
    {
        Assert::string($email);
        Assert::string($password);

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

    /**
     * @Given I am login as :email identified by :password
     *
     * @param string $email
     * @param string $password
     */
    public function iAmLoginAsIdentifiedBy(string $email, string $password): void
    {
        Assert::string($email);
        Assert::string($password);

        $this->thereIsAnAdministratorUserIdentifiedBy($email, $password);

        $this->loginPage->open();
        $this->loginPage->specifyLoginData($email, $password);
        $this->loginPage->logIn();
    }

    /**
     * @When I log out
     */
    public function iLogOut()
    {
        $this->dashboardPage->logOut();
    }

    /**
     * @Then I should see the login page
     */
    public function iShouldSeeTheLoginPage()
    {
        $this->loginPage->verify();
    }

    /**
     * @Then I should not be able to visit dashboard page
     */
    public function iShouldNotBeAbleToVisitDashboardPage()
    {
        try {
            $this->dashboardPage->open();

            throw new \Exception('The Dashboard page should not be able to open.');
        } catch (UnexpectedPageException $e) {
        }
    }
}
