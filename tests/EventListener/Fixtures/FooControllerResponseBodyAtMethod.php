<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures;

use BaxMusic\Bundle\ApiToolkit\Annotation\ResponseBody;

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
