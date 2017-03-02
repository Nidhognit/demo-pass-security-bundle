<?php

namespace DemoBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class AddHeadersListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('X-XSS-Protection', '1; mode=block;');
        $responseHeaders->set('X-Content-Type-Options', 'nosniff');
        $responseHeaders->set('X-Frame-Options', 'DENY');
        $responseHeaders->set('Content-Security-Policy', "default-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' https://camo.githubusercontent.com");
    }
}