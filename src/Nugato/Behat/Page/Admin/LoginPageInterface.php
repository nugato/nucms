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

use Nugato\Behat\Page\PageInterface;

interface LoginPageInterface extends PageInterface
{
    /**
     * @param string $login
     * @param string $password
     */
    public function specifyLoginData(string $login, string $password): void;

    public function logIn(): void;
}
