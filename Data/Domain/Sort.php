<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Data\Domain;

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
    public function __construct(array $directions = null)
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
        if (is_string($properties)) {
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

    private function withDirection(string $newDirection): self
    {
        $directions = array_map(function (Direction $direction) use ($newDirection) {
            return new Direction($newDirection, $direction->getProperty());
        }, $this->directions);

        return new self($directions);
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
