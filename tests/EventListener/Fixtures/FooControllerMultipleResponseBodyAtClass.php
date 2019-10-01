<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;

/**
 * @ResponseBody
 * @ResponseBody
 */
class FooControllerMultipleResponseBodyAtClass
{
    public function barAction()
    {
    }
}
