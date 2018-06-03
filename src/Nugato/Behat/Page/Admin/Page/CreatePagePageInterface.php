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

namespace Nugato\Behat\Page\Admin\Page;

interface CreatePagePageInterface
{
    /**
     * @param string $title
     * @param string $locale
     */
    public function specifyTitle(string $title, string $locale): void;

    /**
     * @param string $content
     * @param string $locale
     */
    public function specifyContent(string $content, string $locale): void;

    /**
     * Press create button
     */
    public function create(): void;
}
