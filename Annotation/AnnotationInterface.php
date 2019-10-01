<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Annotation;

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
