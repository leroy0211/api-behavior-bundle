<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Data\Domain;

use Symfony\Component\HttpFoundation\Request;

class Sort implements \IteratorAggregate
{
    const ASC = 'ASC';
    const DESC = 'DESC';
    const DEFAULT_DIRECTION = self::ASC;

    /** @var Direction[] */
    private $directions = [];

    /**
     * Sort constructor.
     *
     * @param Direction[]|null $directions
     */
    private function __construct(array $directions = null)
    {
        $this->directions = $directions;
    }

    /**
     * @param string|string[] $properties
     * @param string          $direction
     *
     * @return Sort
     */
    public static function by($properties, string $direction = self::ASC): self
    {
        if (\is_string($properties)) {
            $properties = [$properties];
        }

        return new self(array_map(function ($property) use ($direction) {
            return new Direction($direction, $property);
        }, $properties));
    }

    public function and(self $sort): self
    {
        $directions = $this->directions;

        foreach ($sort->directions as $direction) {
            $directions[] = $direction;
        }

        return new self($directions);
    }

    public function ascending(): self
    {
        return $this->withDirection(self::ASC);
    }

    public function descending(): self
    {
        return $this->withDirection(self::DESC);
    }

    public static function unsorted(): self
    {
        return new self([]);
    }

    private function withDirection(string $newDirection): self
    {
        $directions = array_map(function (Direction $direction) use ($newDirection) {
            return new Direction($newDirection, $direction->getProperty());
        }, $this->directions);

        return new self($directions);
    }

    public static function byRequest(Request $request)
    {
        $sortQuery = $request->query->get('sort');

        $sort = new self([]);

        if (null === $sortQuery) {
            return $sort;
        }

        foreach (explode(',', $sortQuery) as $value) {
            $value = trim($value);
            $sort = $sort->and(
                self::by([$value], $request->query->get(sprintf('%s_dir', $value), self::DEFAULT_DIRECTION))
            );
        }

        return $sort;
    }

    /**
     * @return Direction[]
     */
    public function getDirections(): array
    {
        return $this->directions;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->directions);
    }
}
