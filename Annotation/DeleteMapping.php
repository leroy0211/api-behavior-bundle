<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

final class DeleteMapping extends RequestMapping
{
    public function __construct(array $data)
    {
        if (!\in_array($method = 'DELETE', $data['methods'] ?? [])) {
            $data['methods'][] = $method;
        }
        parent::__construct($data);
    }
}
