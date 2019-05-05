<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\EventListener;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseStatus;
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
