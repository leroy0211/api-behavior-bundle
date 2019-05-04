<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\Annotation;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseStatus;
use PHPUnit\Framework\TestCase;

class ResponseStatusTest extends TestCase
{
    public function testGetSetStatus()
    {
        $responseStatus = new ResponseStatus([]);
        $this->assertSame(200, $responseStatus->getStatus());

        $responseStatus->setStatus(201);
        $this->assertSame(201, $responseStatus->getStatus());
    }

    public function testSettersViaConstruct()
    {
        $responseStatus = new ResponseStatus(['status' => 201]);

        $this->assertSame(201, $responseStatus->getStatus());
    }
}
