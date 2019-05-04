<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;

/**
 * @ResponseBody()
 */
class FooControllerResponseBodyAtClassAndMethod
{
    const CLASS_SERIALIZATION_GROUPS = [];
    const METHOD_SERIALIZATION_GROUPS = ['foobar'];

    /**
     * @ResponseBody(serializerGroups={"foobar"})
     */
    public function barAction()
    {
    }

    public function bar2Action()
    {
    }
}
