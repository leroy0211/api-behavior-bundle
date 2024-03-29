<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Annotation;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;
use PHPUnit\Framework\TestCase;

class ResponseBodyTest extends TestCase
{
    public function testSerializerContext()
    {
        $responseBody = new ResponseBody([]);
        $this->assertSame([], $responseBody->getContext());

        $responseBody->setContext($context = ['groups' => ['group']]);
        $this->assertSame($context, $responseBody->getContext());
    }

    public function testSettersViaConstruct()
    {
        $responseBody = new ResponseBody(['context' => ['groups' => ['group']]]);

        $this->assertSame(['groups' => ['group']], $responseBody->getContext());
    }
}
