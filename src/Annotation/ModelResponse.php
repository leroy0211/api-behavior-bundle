<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class ModelResponse
{
    public $status = 200;
}
