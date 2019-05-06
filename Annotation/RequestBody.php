<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
final class RequestBody extends ConfiguredAnnotation
{
    /** @var string */
    private $property;

    /** @var array */
    private $context = [];

    protected function getValueProperty(): ?string
    {
        return 'property';
    }

    /**
     * @return string
     */
    public function getProperty(): ?string
    {
        return $this->property;
    }

    /**
     * @param string $property
     */
    public function setProperty(string $property): void
    {
        $this->property = $property;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @param array $context
     */
    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    public function allowArray(): bool
    {
        return false;
    }

    public function getAliasName(): string
    {
        return 'request_body';
    }
}
