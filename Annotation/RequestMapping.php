<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Annotation;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Annotation
 */
class RequestMapping extends Route implements AnnotationInterface
{
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($method = $this->getMethod()) {
            $this->setMethods(array_merge($this->getMethods(), [$method]));
        }
    }

    public function getMethod(): ?string
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function allowArray(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getAliasName(): string
    {
        return 'request_mapping';
    }
}
