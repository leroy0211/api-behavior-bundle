<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;

class FooControllerResponseBodyAtMethod
{
    const METHOD_CONTEXT = [];

    /**
     * @ResponseBody
     */
    public function barAction()
    {
    }
}
