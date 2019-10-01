<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;
use Flexsounds\Bundle\ApiBehavior\EventListener\ResponseBodyListener;
use Doctrine\Common\Annotations\AnnotationReader;
use Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\EventListener\FooModel;
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
use Symfony\Component\Serializer\SerializerInterface;

class ResponseBodyTest extends TestCase
{
    /**
     * @dataProvider convertingResponsesDataProvider
     */
    public function testConvertsControllerResult($responseObject)
    {
        $listener = new ResponseBodyListener($this->createSerializer());
        $request = $this->createRequest(new ResponseBody([]));
        $event = $this->createEventMock($responseObject, $request);
        $event->expects($this->once())->method('setResponse')->with($this->isInstanceOf(Response::class));
        $listener->onKernelView($event);
    }

    public function convertingResponsesDataProvider()
    {
        return [
            [new FooModel()],
            [''],
            [['foo' => 'bar']],
        ];
    }

    public function testDoesNotConvertsControllerResult()
    {
        $listener = new ResponseBodyListener($this->createMock(SerializerInterface::class));
        $request = $this->createRequest(new ResponseBody([]));
        $event = $this->createEventMock(new Response(), $request);
        $event->expects($this->never())->method('setResponse');
        $listener->onKernelView($event);
    }

    private function createRequest(ResponseBody $responseBody = null)
    {
        return new Request([], [], [
            '_response_body' => $responseBody,
        ]);
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
