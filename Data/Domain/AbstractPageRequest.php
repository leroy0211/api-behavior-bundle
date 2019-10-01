<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Data\Domain;

abstract class AbstractPageRequest implements Pageable
{
    /** @var int */
    private $page;

    /** @var int */
    private $size;

    /**
     * AbstractPageRequest constructor.
     */
    public function __construct(int $page, int $size)
    {
        if ($page < 0) {
            throw new \InvalidArgumentException('Page index must not be less than zero!');
        }

        if ($size < 1) {
            throw new \InvalidArgumentException('Page size must not be less than one!');
        }

        $this->page = $page;
        $this->size = $size;
    }

    public function getPageNumber(): int
    {
        return $this->page;
    }

    public function getPageSize(): int
    {
        return $this->size;
    }

    public function getOffset(): int
    {
        return $this->page * $this->size;
    }

    public function hasPrevious(): bool
    {
        return $this->page > 0;
    }
}
