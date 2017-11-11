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
use Behat\Behat\Tester\Exception\PendingException;
use Nugato\Behat\Page\Admin\LoginPage;
use Webmozart\Assert\Assert;

class LoginContext implements Context
{
    /**
     * @var LoginPage
     */
    private $loginPage;

    public function __construct(LoginPage $loginPage)
    {
        $this->loginPage = $loginPage;
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
        throw new PendingException();
    }

    /**
     * @Then I should see welcome dashboard page
     */
    public function iShouldSeeWelcomeDashboardPage()
    {
        throw new PendingException();
    }
}
