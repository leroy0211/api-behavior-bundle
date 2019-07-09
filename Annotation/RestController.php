<?php

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 */
final class RestController extends ConfiguredAnnotation
{
    /**
     * @inheritDoc
     */
    public function allowArray(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getAliasName(): string
    {
        return 'rest_controller';
    }
}
