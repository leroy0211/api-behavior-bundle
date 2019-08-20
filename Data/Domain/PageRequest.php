<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Data\Domain;

use Doctrine\Common\Collections\Criteria;

class PageRequest extends AbstractPageRequest
{
    /** @var Sort */
    private $sort;

    public static function SortablePageRequest(int $page, int $size, Sort $sort): self
    {
        $pageRequest = new self($page, $size);
        $pageRequest->sort = $sort;

        return $pageRequest;
    }

    public function applyToCriteria(Criteria &$criteria)
    {
        parent::applyToCriteria($criteria);

        $order = [];
        foreach ($this->sort->getDirections() as $direction) {
            $order[$direction->getProperty()] = $direction->getDirection();
        }
        $criteria->orderBy($order);
    }
}
