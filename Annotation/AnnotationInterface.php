<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

interface AnnotationInterface
{
    /**
     * Returns whether multiple annotations of this type are allowed.
     *
     * @return bool
     */
    public function allowArray(): bool;

    /**
     * Returns the alias name for an annotation.
     *
     * @return string
     */
    public function getAliasName(): string;
}
