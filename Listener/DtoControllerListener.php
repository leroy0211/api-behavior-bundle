<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Listener;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\SerializerInterface;

final class DtoControllerListener
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();

        if (!$annotation = $request->attributes->get('_response_body')) {
            return;
        }

        if (!$annotation instanceof ResponseBody) {
            return;
        }

        $response = new JsonResponse();
        $response->setJson($this->serializer->serialize($event->getControllerResult(), 'json'));
        $response->setStatusCode($annotation->getStatus());

        $event->setResponse($response);
    }
}
