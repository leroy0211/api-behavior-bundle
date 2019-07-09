<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 */
final class PostMapping extends RequestMapping
{
    public function getMethod(): ?string
    {
        return 'POST';
    }
}
