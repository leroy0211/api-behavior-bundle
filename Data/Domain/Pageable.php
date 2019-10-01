<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Data\Domain;

interface Pageable
{
    public function getPageNumber(): int;

    public function getPageSize(): int;

    public function getOffset(): int;
}
