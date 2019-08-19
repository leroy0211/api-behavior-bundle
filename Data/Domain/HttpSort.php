<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Data\Domain;

use Symfony\Component\HttpFoundation\Request;

class HttpSort
{
    private $sortParam = 'sort';

    private $sortDirectionParam = '%s_dir';

    /**
     * @param string $sortParam
     *
     * @return HttpSort
     */
    public function setSortParam(string $sortParam): self
    {
        $this->sortParam = $sortParam;

        return $this;
    }

    /**
     * @param string $sortDirectionParam
     *
     * @return HttpSort
     */
    public function setSortDirectionParam(string $sortDirectionParam): self
    {
        $this->sortDirectionParam = $sortDirectionParam;

        return $this;
    }

    public function byRequest(Request $request): Sort
    {
        $sortQuery = $request->query->get($this->sortParam);

        $sort = Sort::unsorted();

        if (null === $sortQuery) {
            return $sort;
        }

        foreach (explode(',', $sortQuery) as $sortItem) {
            $sortItem = trim($sortItem);
            $sort = $sort->and(
                Sort::by([$sortItem], $request->query->get(sprintf($this->sortDirectionParam, $sortItem), Sort::DEFAULT_DIRECTION))
            );
        }

        return $sort;
    }
}
