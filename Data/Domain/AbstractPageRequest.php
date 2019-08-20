<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Data\Domain;

use Doctrine\Common\Collections\Criteria;

abstract class AbstractPageRequest implements Pageable
{
    /** @var int */
    private $page;

    /** @var int */
    private $size;

    /**
     * AbstractPageRequest constructor.
     *
     * @param int $page
     * @param int $size
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

    public function getPageSize(): int
    {
        return $this->size;
    }

    public function getPageNumber(): int
    {
        return $this->page;
    }

    public function getOffset(): int
    {
        return $this->page * $this->size;
    }

    public function hasPrevious(): bool
    {
        return $this->page > 0;
    }

    public function applyToCriteria(Criteria &$criteria)
    {
        $criteria->setFirstResult($this->getOffset());
        $criteria->setMaxResults($this->getPageSize());
    }
}
