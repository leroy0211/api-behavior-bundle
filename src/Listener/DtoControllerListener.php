<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Listener;

use BaxMusic\Bundle\ApiToolkit\Annotation\ModelResponse;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\SerializerInterface;

final class DtoControllerListener
{
    private $serializer;

    private $reader;

    public function __construct(Reader $reader, SerializerInterface $serializer)
    {
        $this->reader = $reader;
        $this->serializer = $serializer;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $controllers = $event->getController();
        if (!is_array($controllers)) {
            return;
        }

        $request = $event->getRequest();

        $this->handleAnnotation($controllers, $request);
    }

    private function handleAnnotation(iterable $controllers, Request $request): void
    {
        list($controller, $method) = $controllers;

        try {
            $controller = new \ReflectionClass($controller);
            $this->handleMethodAnnotation($controller, $method, $request);
        } catch (\ReflectionException $e) {
            throw new \RuntimeException('Failed to read annotation!');
        }
    }

    private function handleMethodAnnotation(\ReflectionClass $controller, string $method, Request $request): void
    {
        $method = $controller->getMethod($method);
        $annotation = $this->reader->getMethodAnnotation($method, ModelResponse::class);

        if ($annotation instanceof ModelResponse) {
            $request->attributes->set('_model_response', $annotation);
        }
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $data = $event->getControllerResult();
        $request = $event->getRequest();

        $model = $request->attributes->get('_model_response');

        if (!$model instanceof ModelResponse) {
            return;
        }

        $data = $this->serializer->serialize($data, 'json');

        $response = new JsonResponse($data, $model->status, [], true);

        $event->setResponse($response);
    }
}
