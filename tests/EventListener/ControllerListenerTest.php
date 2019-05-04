<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;
use BaxMusic\Bundle\ApiToolkit\EventListener\ControllerListener;
use BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures\FooControllerMultipleResponseBodyAtClass;
use BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures\FooControllerMultipleResponseBodyAtMethod;
use BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures\FooControllerResponseBodyAtClass;
use BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures\FooControllerResponseBodyAtClassAndMethod;
use BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures\FooControllerResponseBodyAtMethod;
use Doctrine\Common\Annotations\AnnotationReader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ControllerListenerTest extends TestCase
{
    public function setUp()
    {
        $this->listener = new ControllerListener(new AnnotationReader());
        $this->request = $this->createRequest();
    }

    public function tearDown()
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
        $this->assertEquals(FooControllerResponseBodyAtMethod::METHOD_SERIALIZATION_GROUPS, $this->getReadedCache()->getSerializerGroups());
    }

    public function testCacheAnnotationAtClass()
    {
        $controller = new FooControllerResponseBodyAtClass();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);

        $this->assertNotNull($this->getReadedCache());
        $this->assertEquals(FooControllerResponseBodyAtClass::CLASS_SERIALIZATION_GROUPS, $this->getReadedCache()->getSerializerGroups());
    }

    public function testCacheAnnotationAtClassAndMethod()
    {
        $controller = new FooControllerResponseBodyAtClassAndMethod();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);

        $this->assertNotNull($this->getReadedCache());
        $this->assertEquals(FooControllerResponseBodyAtClassAndMethod::METHOD_SERIALIZATION_GROUPS, $this->getReadedCache()->getSerializerGroups());

        $this->event = $this->getFilterControllerEvent([$controller, 'bar2Action'], $this->request);
        $this->listener->onKernelController($this->event);

        $this->assertNotNull($this->getReadedCache());
        $this->assertEquals(FooControllerResponseBodyAtClassAndMethod::CLASS_SERIALIZATION_GROUPS, $this->getReadedCache()->getSerializerGroups());
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Multiple "response_body" annotations are not allowed
     */
    public function testMultipleAnnotationsOnClassThrowsExceptionUnlessConfigurationAllowsArray()
    {
        $controller = new FooControllerMultipleResponseBodyAtClass();
        $this->event = $this->getFilterControllerEvent([$controller, 'barAction'], $this->request);
        $this->listener->onKernelController($this->event);
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Multiple "response_body" annotations are not allowed
     */
    public function testMultipleAnnotationsOnMethodThrowsExceptionUnlessConfigurationAllowsArray()
    {
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
