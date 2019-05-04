<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;

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
