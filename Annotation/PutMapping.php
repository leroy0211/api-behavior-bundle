<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

final class PutMapping extends RequestMapping
{
    public function __construct(array $data)
    {
        if (!\in_array($method = 'PUT', $data['methods'] ?? [])) {
            $data['methods'][] = $method;
        }
        parent::__construct($data);
    }
}
