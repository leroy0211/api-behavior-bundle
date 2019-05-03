<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Annotation;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class ResponseBody extends ConfiguredAnnotation
{
    private $status = 200;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
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
