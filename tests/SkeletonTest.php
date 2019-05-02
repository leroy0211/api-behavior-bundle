<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests;

use BaxMusic\Bundle\ApiToolkit\Annotation\ModelResponse;
use BaxMusic\Bundle\ApiToolkit\Listener\DtoControllerListener;
use BaxMusic\Bundle\ApiToolkit\Tests\Fixtures\Model;
use Doctrine\Common\Annotations\Reader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SkeletonTest extends TestCase
{
    /**
     * @test
     */
    public function test_something()
    {
        $this->assertTrue(true);
    }

    public function test_response()
    {
        $serializer = new Serializer([
            new GetSetMethodNormalizer(),
            new ObjectNormalizer(),
        ], [
            new JsonEncoder(),
        ]);

        $reader = $this->createMock(Reader::class);

        $listener = new DtoControllerListener($reader, $serializer);

        $modelResponse = new ModelResponse();
        $modelResponse->status = 201;

        $request = new Request([], [], ['_model_response' => $modelResponse]);

        $eventMock = \Mockery::mock(GetResponseForControllerResultEvent::class);
        $eventMock->makePartial();
        $eventMock->allows([
            'getControllerResult' => new Model(),
            'getRequest' => $request,
        ]);

        $listener->onKernelView($eventMock);

        $this->assertSame(201, $eventMock->getResponse()->getStatusCode());
        $this->assertSame('{"key":null}', $eventMock->getResponse()->getContent());
    }
}
