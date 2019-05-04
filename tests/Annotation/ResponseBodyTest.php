<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\Annotation;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;
use PHPUnit\Framework\TestCase;

class ResponseBodyTest extends TestCase
{
    public function testSingleSerializerGroup()
    {
        $responseBody = new ResponseBody([]);
        $this->assertSame([], $responseBody->getContext());

        $responseBody->setSerializerGroups('group');
        $this->assertSame(['group'], $responseBody->getSerializerGroups());
    }

    public function testArraySerializerGroups()
    {
        $responseBody = new ResponseBody([]);
        $responseBody->setSerializerGroups(['group']);

        $this->assertSame(['group'], $responseBody->getSerializerGroups());
    }

    public function testSettersViaConstruct()
    {
        $responseBody = new ResponseBody(['serializerGroups' => 'group']);

        $this->assertSame(['group'], $responseBody->getSerializerGroups());

        $responseBody = new ResponseBody(['serializerGroups' => ['groupA', 'groupB']]);

        $this->assertSame(['groupA', 'groupB'], $responseBody->getSerializerGroups());
    }
}
