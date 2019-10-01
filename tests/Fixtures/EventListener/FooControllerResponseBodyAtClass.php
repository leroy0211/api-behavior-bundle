<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\EventListener;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;

/**
 * @ResponseBody
 */
class FooControllerResponseBodyAtClass
{
    const CLASS_CONTEXT = [];

    public function barAction()
    {
    }
}
