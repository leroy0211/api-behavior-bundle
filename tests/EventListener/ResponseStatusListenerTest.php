<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseStatus;
use BaxMusic\Bundle\ApiToolkit\EventListener\ResponseStatusListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ResponseStatusListenerTest extends TestCase
{
    public function testAddStatusCodeToResponse()
    {
        $listener = new ResponseStatusListener();
        $request = $this->createRequest($responseStatus = new ResponseStatus([]));
        $responseStatus->setStatus(201);

        $event = $this->createEventMock($request, $response = new Response());
        $listener->onKernelResponse($event);

        $this->assertSame(201, $response->getStatusCode());
    }

    private function createRequest(ResponseStatus $responseStatus = null)
    {
        return new Request([], [], [
            '_response_status' => $responseStatus,
        ]);
    }

    private function createEventMock(Request $request, Response $response = null)
    {
        $event = $this
            ->getMockBuilder(FilterResponseEvent::class)
            ->setMethods(['getRequest'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $event
            ->expects($this->any())
            ->method('getRequest')
            ->willReturn($request)
        ;

        if ($response) {
            $event->setResponse($response);
        }

        return $event;
    }
}
