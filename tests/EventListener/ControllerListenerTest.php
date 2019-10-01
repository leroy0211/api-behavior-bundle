<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;
use Flexsounds\Bundle\ApiBehavior\EventListener\ControllerListener;
use Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures\FooControllerMultipleResponseBodyAtClass;
use Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures\FooControllerMultipleResponseBodyAtMethod;
use Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures\FooControllerResponseBodyAtClass;
use Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures\FooControllerResponseBodyAtClassAndMethod;
use Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures\FooControllerResponseBodyAtMethod;
use Doctrine\Common\Annotations\AnnotationReader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ControllerListenerTest extends TestCase
{
    public function setUp(): void
    {
        $this->listener = new ControllerListener(new AnnotationReader());
        $this->request = $this->createRequest();
    }

    public function tearDown(): void
    {
        $this->listener = null;
        $this->request = null;
    }

    public function testCacheAnnotationAtMethod()
    {
        $controller = new FooControllerResponseBodyAtMethod();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);

        $this->assertNotNull($this->getReadedCache());
        $this->assertEquals(FooControllerResponseBodyAtMethod::METHOD_CONTEXT, $this->getReadedCache()->getContext());
    }

    public function testCacheAnnotationAtClass()
    {
        $controller = new FooControllerResponseBodyAtClass();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);

        $this->assertNotNull($this->getReadedCache());
        $this->assertEquals(FooControllerResponseBodyAtClass::CLASS_CONTEXT, $this->getReadedCache()->getContext());
    }

    public function testCacheAnnotationAtClassAndMethod()
    {
        $controller = new FooControllerResponseBodyAtClassAndMethod();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);

        $this->assertNotNull($this->getReadedCache());
        $this->assertEquals(FooControllerResponseBodyAtClassAndMethod::METHOD_CONTEXT, $this->getReadedCache()->getContext());

        $this->event = $this->getFilterControllerEvent([$controller, 'bar2Action'], $this->request);
        $this->listener->onKernelController($this->event);

        $this->assertNotNull($this->getReadedCache());
        $this->assertEquals(FooControllerResponseBodyAtClassAndMethod::CLASS_CONTEXT, $this->getReadedCache()->getContext());
    }

    public function testMultipleAnnotationsOnClassThrowsExceptionUnlessConfigurationAllowsArray()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Multiple "response_body" annotations are not allowed');
        $controller = new FooControllerMultipleResponseBodyAtClass();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);
    }

    public function testMultipleAnnotationsOnMethodThrowsExceptionUnlessConfigurationAllowsArray()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Multiple "response_body" annotations are not allowed');
        $controller = new FooControllerMultipleResponseBodyAtMethod();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);
    }

    private function createRequest(ResponseBody $responseBody = null)
    {
        return new Request([], [], [
            '_response_body' => $responseBody,
        ]);
    }

    private function getFilterControllerEvent($controller, Request $request)
    {
        $mockKernel = $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', ['', '']);

        return new FilterControllerEvent($mockKernel, $controller, $request, HttpKernelInterface::MASTER_REQUEST);
    }

    /**
     * @return ResponseBody|null
     */
    private function getReadedCache()
    {
        return $this->request->attributes->get('_response_body');
    }
}
