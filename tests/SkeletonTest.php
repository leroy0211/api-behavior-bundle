<?php

namespace BaxMusic\Bundle\ApiToolkit\Tests;

use BaxMusic\Bundle\ApiToolkit\Listener\DtoControllerListener;
use BaxMusic\Bundle\ApiToolkit\Model\DtoInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\SecurityBundle\Tests\Functional\app\AppKernel;
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
            new ObjectNormalizer()
        ], [
            new JsonEncoder()
        ]);

        $listener = new DtoControllerListener($serializer);

        $eventMock = $this->getMockBuilder(GetResponseForControllerResultEvent::class)
            ->disableOriginalConstructor()
            ->getMock();

        $eventMock
            ->expects($this->once())
            ->method('getControllerResult')
            ->willReturn($this->createMock(DtoInterface::class));

        $eventMock
            ->expects($this->once())
            ->method('setResponse');

        $listener->onKernelView($eventMock);

        $this->assertNull($eventMock->getResponse());
    }
}
