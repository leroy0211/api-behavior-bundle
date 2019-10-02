<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Data\Domain;

use BadMethodCallException;
use Symfony\Component\HttpFoundation\Request;
use Webmozart\Assert\Assert;

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
     * @param string[] $properties
     *
     * @return Sort
     */
    public static function by(string ...$properties): self
    {
        Assert::notNull($properties, 'Properties must not be null!');
        Assert::minCount($properties, 1, 'At least one property must be given!');

        return new self(array_map(function ($property){
            return new Direction(self::DEFAULT_DIRECTION, $property);
        }, $properties));
    }

    public static function byDirection(string $direction, string ...$properties): self
    {
        return self::by(...$properties)->withDirection($direction);
    }

    public function isSorted(): bool
    {
        return !empty($this->directions);
    }

    public function isUnsorted(): bool
    {
        return !$this->isSorted();
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

    public function getOrderFor(string $property): ?string
    {
        foreach ($this->directions as $direction) {
            if ($direction->getProperty() === $property) {
                return $direction->getDirection();
            }
        }

        return null;
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