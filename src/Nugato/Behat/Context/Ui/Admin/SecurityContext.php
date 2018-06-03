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

namespace Nugato\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Nugato\Behat\Page\Admin\DashboardPage;
use Nugato\Behat\Page\Admin\LoginPage;

class SecurityContext extends RawMinkContext implements Context
{
    /**
     * @var LoginPage
     */
    private $loginPage;

    /**
     * @var DashboardPage
     */
    private $dashboardPage;

    /**
     * SecurityContext constructor.
     *
     * @param LoginPage $loginPage
     * @param DashboardPage $dashboardPage
     */
    public function __construct(LoginPage $loginPage, DashboardPage $dashboardPage)
    {
        $this->loginPage = $loginPage;
        $this->dashboardPage = $dashboardPage;
    }

    /**
     * @Given I want to log in
     */
    public function iWantToLogIn()
    {
        $this->loginPage->open();
    }

    /**
     * @Then I specify login data :login :password
     */
    public function iSpecifyLoginData($login, $password)
    {
        $this->loginPage->specifyLoginData($login, $password);
    }

    /**
     * @Then I log in
     */
    public function iLogIn()
    {
        $this->loginPage->logIn();
    }

    /**
     * @Then I should be logged in
     */
    public function iShouldBeLoggedIn()
    {
        $this->dashboardPage->verify();
    }

    /**
     * @Then I should not be logged in
     */
    public function iShouldNotBeLoggedIn()
    {
        $this->loginPage->verify();
    }

    /**
     * @Then I should see error message
     */
    public function iShouldSeeErrorMessage()
    {
        $this->loginPage->getErrorMessageElement();
    }

    /**
     * @Given I am on the dashboard page
     */
    public function iAmOnTheDashboardPage()
    {
        $this->dashboardPage->open();
    }
}
