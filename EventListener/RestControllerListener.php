<?php

namespace BaxMusic\Bundle\ApiToolkit\EventListener;

use BaxMusic\Bundle\ApiToolkit\Annotation\RestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\SerializerInterface;

final class RestControllerListener
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();

        if (!$annotation = $request->attributes->get('_rest_controller')) {
            return;
        }

        // Limit activation to methods annotated with RequestMapping
        if (!$request->attributes->has('_request_mapping')){
            return;
        }

        if (!$annotation instanceof RestController) {
            return;
        }

        $controllerResult = $event->getControllerResult();

        if ($controllerResult instanceof Response) {
            return;
        }

        $response = new JsonResponse();
        $response->setJson($this->serializer->serialize($controllerResult, 'json'));

        $event->setResponse($response);
    }

}
