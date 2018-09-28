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

namespace Nugato\Bundle\NuCmsBundle\Component\Page\Service;

use Nugato\Bundle\NuCmsBundle\Entity\PageInterface;

class PageTemplateResolver implements PageTemplateResolverInterface
{
    /**
     * @var array
     */
    private $templates;

    public function __construct(array $templates = [])
    {
        $this->templates = $this->prepareTemplatesArray($templates);
    }

    public function resolveTemplateName(PageInterface $page): string
    {
        if ($page->hasTemplateSelected() && isset($this->templates[$page->getTemplate()])) {
            return $this->templates[$page->getTemplate()]['template'];
        }

        $firstTemplate = reset($this->templates);

        return $firstTemplate['template'];
    }

    private function prepareTemplatesArray(array $templates): array
    {
        $result = [];

        foreach ($templates as $template) {
            $result[$template['code']] = $template;
        }

        return $result;
    }
}
