<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Annotation
 */
class RequestMapping extends Route
{
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (!$this->getMethods()) {
            $this->setMethods((array) $this->getMethod());
        }
    }

    public function getMethod(): ?string
    {
        return null;
    }
}
