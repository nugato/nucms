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

namespace Nugato\Bundle\NuCmsBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Nugato\Bundle\NuCmsBundle\Menu\Event\AdminMenuBuilderEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class AdminBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param FactoryInterface $factory
     *
     * @param array $options
     * @return ItemInterface
     */
    public function build(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('dashboard', [
            'label' => 'nucms.ui.menu.items.dashboard',
            'route' => 'nucms_admin_dashboard',
            'extras' => ['icon' => 'home'],
        ]);

        $menu->addChild('page', [
            'label' => 'nucms.ui.menu.items.pages',
            'route' => 'nucms_admin_page_index',
            'extras' => ['icon' => 'file'],
        ]);

        $menu->addChild('taxon', [
            'label' => 'nucms.ui.menu.items.taxons',
            'route' => 'nucms_admin_taxon_index',
            'extras' => ['icon' => 'book'],
        ]);

        $menu->addChild('locale', [
            'label' => 'nucms.ui.menu.items.locales',
            'route' => 'nucms_admin_locale_index',
            'extras' => ['icon' => 'language'],
        ]);

        $menu->addChild('navigation', [
            'label' => 'nucms.ui.menu.items.navigations',
            'route' => 'nucms_admin_navigation_index',
            'extras' => ['icon' => 'sitemap'],
        ]);

        $menu->addChild('file', [
            'label' => 'nucms.ui.menu.items.files',
            'route' => 'nucms_admin_file_index',
            'extras' => ['icon' => 'files-o'],
        ]);

        $this->container->get('event_dispatcher')->dispatch(
            AdminMenuBuilderEvent::BUILDER,
            new AdminMenuBuilderEvent($factory, $menu)
        );

        return $menu;
    }
}
