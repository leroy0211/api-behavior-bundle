<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Annotation;

use Flexsounds\Bundle\ApiBehavior\Annotation\RequestBody;
use PHPUnit\Framework\TestCase;

class RequestBodyTest extends TestCase
{
    public function testGetProperty()
    {
        $requestBody = new RequestBody([]);
        $this->assertNull($requestBody->getProperty());

        $requestBody->setProperty('fooBar');
        $requestBody->setContext($context = ['groups' => ['foo']]);

        $this->assertSame('fooBar', $requestBody->getProperty());
        $this->assertSame($context, $requestBody->getContext());
    }

    public function testSettersViaConstruct()
    {
        $requestBody = new RequestBody(['property' => 'fooBar']);

        $this->assertSame('fooBar', $requestBody->getProperty());
    }

    public function testValueToPropertyConverting()
    {
        $requestBody = new RequestBody([
            'value' => 'fooBar',
        ]);

        $this->assertSame('fooBar', $requestBody->getProperty());
    }
}
