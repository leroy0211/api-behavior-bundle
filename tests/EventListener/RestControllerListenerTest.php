<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener;

use Flexsounds\Bundle\ApiBehavior\Annotation\RequestMapping;
use Flexsounds\Bundle\ApiBehavior\Annotation\RestController;
use Flexsounds\Bundle\ApiBehavior\EventListener\RestControllerListener;
use Doctrine\Common\Annotations\AnnotationReader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RestControllerListenerTest extends TestCase
{
    public function testDoNotApplyWithoutRequestMapping()
    {
        $listener = new RestControllerListener($this->createSerializer());
        $request = $this->createRequest(new RestController([]));
        $event = $this->createEventMock(['foo' => 'bar'], $request);
        $event->expects($this->never())->method('setResponse');
        $listener->onKernelView($event);
    }

    public function testApplyWithRequestMapping()
    {
        $listener = new RestControllerListener($this->createSerializer());
        $request = $this->createRequest(new RestController([]), true);
        $event = $this->createEventMock(['foo' => 'bar'], $request);
        $event->expects($this->once())->method('setResponse')->with($this->isInstanceOf(Response::class));
        $listener->onKernelView($event);
    }

    private function createEventMock($controllerResult, Request $request)
    {
        $event = $this
            ->getMockBuilder(GetResponseForControllerResultEvent::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $event
            ->expects($this->any())
            ->method('getRequest')
            ->willReturn($request)
        ;

        $event
            ->expects($this->any())
            ->method('getControllerResult')
            ->willReturn($controllerResult)
        ;

        return $event;
    }

    private function createRequest(RestController $restController, bool $withRequestMapping = false)
    {
        $attributes = [
            '_rest_controller' => $restController,
        ];

        if ($withRequestMapping) {
            $attributes['_request_mapping'] = [new RequestMapping([])];
        }

        return new Request([], [], $attributes);
    }

    private function createSerializer()
    {
        $classMetaDataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        return new Serializer([
            new GetSetMethodNormalizer($classMetaDataFactory),
            new ObjectNormalizer($classMetaDataFactory),
        ], [
            new JsonEncoder(),
        ]);
    }
}
