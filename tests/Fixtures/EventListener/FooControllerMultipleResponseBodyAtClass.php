<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\EventListener;

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
