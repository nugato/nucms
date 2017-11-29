<?php

namespace Nugato\Bundle\NuCmsBundle\EventSubscriber;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var string
     */
    private $adminPrefix;

    public function __construct($defaultLocale = 'en', $adminPrefix = 'admin')
    {
        $this->defaultLocale = $defaultLocale;
        $this->adminPrefix = $adminPrefix;
    }

    /**
     * {@inheritdoc}
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$request->hasPreviousSession()) {
            return;
        }

        $localeAdmin = $request->getSession()->get('_locale_admin');

        if (null !== $localeAdmin && strpos($request->getPathInfo(), $this->adminPrefix)) {
            $request->setLocale($localeAdmin);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            // must be registered after the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 15]],
        ];
    }
}
