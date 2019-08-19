<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Data\Domain;

class Direction
{
    const ASC = 'ASC';
    const DESC = 'DESC';

    /** @var string */
    private $direction;

    /** @var string */
    private $property;

    /**
     * Direction constructor.
     *
     * @param string $direction
     * @param string $property
     */
    public function __construct(string $direction, string $property)
    {
        $this->direction = $direction;
        $this->property = $property;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }
}
