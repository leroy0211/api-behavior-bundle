<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 */
final class PostMapping extends RequestMapping
{
    public function __construct(array $data)
    {
        if (!\in_array($method = 'POST', $data['methods'] ?? [])) {
            $data['methods'][] = $method;
        }
        parent::__construct($data);
    }
}
