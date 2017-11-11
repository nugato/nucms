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

class LoginPage extends Page implements LoginPageInterface
{
    /**
     * @var string|null
     */
    protected $path = '/admin/login';

    /**
     * @param string $login
     * @param string $password
     */
    public function specifyLoginData(string $login, string $password): void
    {
        $this->fillField('Login', $login);
        $this->fillField('Password', $password);
    }

    public function logIn(): void
    {
        $this->pressButton('Login');
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'nucms_admin_login';
    }
}
