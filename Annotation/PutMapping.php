<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 */
final class PutMapping extends RequestMapping
{
    public function getMethod(): ?string
    {
        return 'PUT';
    }
}
