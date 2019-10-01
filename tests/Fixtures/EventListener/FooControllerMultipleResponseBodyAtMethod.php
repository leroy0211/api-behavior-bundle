<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\EventListener;

use Flexsounds\Bundle\ApiBehavior\Annotation\ResponseBody;

class FooControllerMultipleResponseBodyAtMethod
{
    /**
     * @ResponseBody
     * @ResponseBody
     */
    public function barAction()
    {
    }
}
