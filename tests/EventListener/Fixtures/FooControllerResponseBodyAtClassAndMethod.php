<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;

/**
 * @ResponseBody()
 */
class FooControllerResponseBodyAtClassAndMethod
{
    const CLASS_CONTEXT = [];
    const METHOD_CONTEXT = ['groups' => ['foobar']];

    /**
     * @ResponseBody(context={"groups"={"foobar"}})
     */
    public function barAction()
    {
    }

    public function bar2Action()
    {
    }
}
