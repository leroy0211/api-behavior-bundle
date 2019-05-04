<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;

/**
 * @ResponseBody
 */
class FooControllerResponseBodyAtClass
{
    const CLASS_SERIALIZATION_GROUPS = [];

    public function barAction()
    {
    }
}
