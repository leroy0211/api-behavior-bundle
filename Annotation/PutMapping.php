<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Annotation;

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
