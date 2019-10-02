<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Data\Domain;

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

        foreach (explode(',', $sortQuery) as $value) {
            $value = trim($value);
            $sort = $sort->and(
                Sort::byDirection(
                    $request->query->get(sprintf($this->sortDirectionParam, $value), Sort::DEFAULT_DIRECTION),
                    trim($value)
                )
            );
        }

        return $sort;
    }
}
