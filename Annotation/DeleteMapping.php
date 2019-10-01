<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Annotation;

/**
 * @Annotation
 */
final class DeleteMapping extends RequestMapping
{
    public function getMethod(): ?string
    {
        return 'DELETE';
    }
}
