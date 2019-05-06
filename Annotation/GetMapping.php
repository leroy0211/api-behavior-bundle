<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 */
final class GetMapping extends RequestMapping
{
    public function __construct(array $data)
    {
        if (!\in_array($method = 'GET', $data['methods'] ?? [])) {
            $data['methods'][] = $method;
        }
        parent::__construct($data);
    }
}
