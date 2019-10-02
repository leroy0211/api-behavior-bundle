<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Repository;

use Flexsounds\Bundle\ApiBehavior\Data\Domain\Pageable;
use Doctrine\ORM\EntityRepository;

class PaginatedRepository
{
    /** @var EntityRepository */
    private $repository;

    public function findAll(Pageable $pageable)
    {
        return $this->repository->findBy([], null, $pageable->getPageSize(), $pageable->getOffset());
    }
}
