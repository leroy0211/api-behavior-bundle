<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 */
final class RestController extends ConfiguredAnnotation
{
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
        return 'rest_controller';
    }
}
