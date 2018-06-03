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

namespace spec\Nugato\Bundle\NuCmsBundle\EventSubscriber;

use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LocaleSubscriberSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('en_US', 'admin');
    }

    function it_implements_a_event_subscriber_interface(): void
    {
        $this->shouldImplement(EventSubscriberInterface::class);
    }

    function it_set_locale_if_admin_session_locale_exists_for_admin_prefix_urls(
        GetResponseEvent $event,
        Request $request,
        SessionInterface $session
    ): void {
        $session->get('_locale_admin')->willReturn('en_US');
        $request->hasPreviousSession()->willReturn(true);
        $request->getSession()->willReturn($session);
        $request->getPathInfo()->willReturn('/admin/');
        $event->getRequest()->willReturn($request);

        $request->setLocale('en_US')->shouldBeCalled();

        $this->onKernelRequest($event);
    }

    function it_dont_set_locale_if_admin_session_locale_not_exists_for_admin_prefix_urls(
        GetResponseEvent $event,
        Request $request,
        SessionInterface $session
    ): void {
        $session->get('_locale_admin')->willReturn(null);
        $request->hasPreviousSession()->willReturn(true);
        $request->getSession()->willReturn($session);
        $request->getPathInfo()->willReturn('/admin/');
        $event->getRequest()->willReturn($request);

        $request->setLocale('en_US')->shouldNotBeCalled();

        $this->onKernelRequest($event);
    }

    function it_dont_set_locale_if_admin_session_locale_exists_but_there_is_no_admin_prefix_in_url(
        GetResponseEvent $event,
        Request $request,
        SessionInterface $session
    ): void {
        $session->get('_locale_admin')->willReturn('en_US');
        $request->hasPreviousSession()->willReturn(true);
        $request->getSession()->willReturn($session);
        $request->getPathInfo()->willReturn('/wrong/');
        $event->getRequest()->willReturn($request);

        $request->setLocale('en_US')->shouldNotBeCalled();

        $this->onKernelRequest($event);
    }
}
