<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

use Symfony\Component\HttpFoundation\Response;

/**
 * @Annotation
 */
final class ResponseStatus extends ConfiguredAnnotation
{
    /**
     * @var int
     */
    private $status = Response::HTTP_OK;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function allowArray(): bool
    {
        return false;
    }

    public function getAliasName(): string
    {
        return 'response_status';
    }
}
