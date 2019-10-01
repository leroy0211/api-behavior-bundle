<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Annotation;

use Flexsounds\Bundle\ApiBehavior\Annotation\RequestMapping;
use Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\Annotation\GetMapping;
use PHPUnit\Framework\TestCase;

class RequestMappingTest extends TestCase
{
    public function testMethods()
    {
        foreach (['GET', 'POST', 'PUT', 'PATCH', 'DELETE'] as $method) {
            $class = sprintf('Flexsounds\Bundle\ApiBehavior\Annotation\%sMapping', ucfirst(strtolower($method)));
            /** @var RequestMapping $mapping */
            $mapping = new $class([]);

            $this->assertContains($method, $mapping->getMethods());
        }
    }

    public function testMethodIsAlwaysAdded()
    {
        $getMapping = new GetMapping(['methods' => ['POST']]);

        $this->assertContains('GET', $getMapping->getMethods());
        $this->assertContains('POST', $getMapping->getMethods());
    }
}
