<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures;

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
