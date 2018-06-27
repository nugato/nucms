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

use Nugato\Bundle\NuCmsBundle\Component\User\Entity\User;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserLocaleSubscriberSpec extends ObjectBehavior
{
    function let(SessionInterface $session)
    {
        $this->beConstructedWith($session);
    }

    function it_implements_a_event_subscriber_interface(): void
    {
        $this->shouldImplement(EventSubscriberInterface::class);
    }

    function it_set_locale_in_request_and_admin_locale_in_session_for_specific_user_locale(
        SessionInterface $session,
        InteractiveLoginEvent $event,
        TokenInterface $authenticationToken,
        Request $request
    ) {
        $user = new User();
        $user->setLocaleCode('en_US');
        $authenticationToken->getUser()->willReturn($user);
        $event->getAuthenticationToken()->willReturn($authenticationToken);
        $event->getRequest()->willReturn($request);

        $request->setLocale('en_US')->shouldBeCalled();
        $session->set('_locale_admin', 'en_US')->shouldBeCalled();

        $this->onInteractiveLogin($event);
    }

    function it_do_nothing_if_user_token_does_not_exists(
        SessionInterface $session,
        InteractiveLoginEvent $event,
        TokenInterface $authenticationToken,
        Request $request
    ) {
        $authenticationToken->getUser()->willReturn(null);
        $event->getAuthenticationToken()->willReturn($authenticationToken);

        $request->setLocale()->shouldNotBeCalled();
        $session->set()->shouldNotBeCalled();

        $this->onInteractiveLogin($event);
    }

    function it_do_nothing_if_user_has_no_locale_code(
        SessionInterface $session,
        InteractiveLoginEvent $event,
        TokenInterface $authenticationToken,
        Request $request
    ) {
        $user = new User();
        $authenticationToken->getUser()->willReturn($user);
        $event->getAuthenticationToken()->willReturn($authenticationToken);

        $request->setLocale()->shouldNotBeCalled();
        $session->set()->shouldNotBeCalled();

        $this->onInteractiveLogin($event);
    }
}
