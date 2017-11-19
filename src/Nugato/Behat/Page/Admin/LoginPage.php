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

namespace Nugato\Behat\Page\Admin;

use Nugato\Behat\Page\Page;
use SensioLabs\Behat\PageObjectExtension\PageObject\Element;

class LoginPage extends Page implements LoginPageInterface
{
    /**
     * @var string|null
     */
    protected $path = '/admin/login';

    /**
     * @var array
     */
    protected $elements = [
        'Error message' => 'div.t-error_msg',
        'Login button' => '.t-login_button',
    ];

    /**
     * @param string $login
     * @param string $password
     */
    public function specifyLoginData(string $login, string $password): void
    {
        $this->fillField('Login', $login);
        $this->fillField('Password', $password);
    }

    /**
     * {@inheritdoc}
     */
    public function logIn(): void
    {
        $this->getElement('Login button')->press();
    }

    /**
     * @return Element
     */
    public function getErrorMessageElement(): Element
    {
        return $this->getElement('Error message');
    }
}
