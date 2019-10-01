<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Annotation;

/**
 * @Annotation
 */
final class ResponseBody extends ConfiguredAnnotation
{
    /** @var array */
    private $context = [];

    public function getContext(): array
    {
        return $this->context;
    }

    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    public function allowArray(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getAliasName(): string
    {
        return 'response_body';
    }
}
