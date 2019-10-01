<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\EventListener;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\SerializerInterface;

final class ResponseBodyListener
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

        $controllerResult = $event->getControllerResult();

        if ($controllerResult instanceof Response) {
            return;
        }

        $context = $annotation->getContext();

        $response = new JsonResponse();
        $response->setJson($data = $this->serializer->serialize($controllerResult, 'json', $context));

        $event->setResponse($response);
    }
}
