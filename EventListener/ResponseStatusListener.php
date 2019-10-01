<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\EventListener;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseStatus;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

final class ResponseStatusListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();

        if (!$annotation = $request->attributes->get('_response_status')) {
            return;
        }

        if (!$annotation instanceof ResponseStatus) {
            return;
        }

        $event->getResponse()->setStatusCode($annotation->getStatus());
    }
}
