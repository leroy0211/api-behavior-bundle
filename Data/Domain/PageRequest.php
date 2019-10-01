<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Data\Domain;

use Doctrine\Common\Collections\Criteria;

class PageRequest extends AbstractPageRequest
{
    /** @var Sort */
    private $sort;

    public static function sortablePageRequest(int $page, int $size, Sort $sort): self
    {
        $pageRequest = new self($page, $size);
        $pageRequest->sort = $sort;

        return $pageRequest;
    }

    public function applyToCriteria(Criteria $criteria)
    {
        $criteria->setFirstResult($this->getOffset());
        $criteria->setMaxResults($this->getPageSize());

        $order = [];
        foreach ($this->sort->getDirections() as $direction) {
            $order[$direction->getProperty()] = $direction->getDirection();
        }

        $criteria->orderBy($order);
    }
}
