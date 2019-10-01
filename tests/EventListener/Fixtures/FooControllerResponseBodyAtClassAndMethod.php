<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;

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
