<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Data\Domain;

use Flexsounds\Bundle\ApiBehavior\Data\Domain\Direction;
use Flexsounds\Bundle\ApiBehavior\Data\Domain\Sort;
use PHPUnit\Framework\TestCase;

class SortTest extends TestCase
{
    public function testAppliesDefaultForOrder()
    {
        $sort = Sort::by('foo');

        $this->assertSame(Sort::DEFAULT_DIRECTION, $sort->getIterator()->current()->getDirection());
        $this->assertSame(Sort::DEFAULT_DIRECTION, $sort->getDirections()[0]->getDirection());

        $this->assertSame(Sort::DEFAULT_DIRECTION, $sort->getOrderFor('foo'));
        $this->assertNull($sort->getOrderFor('bar'));
    }

    public function testMultipleProperties()
    {
        $sort = Sort::by('foo', 'bar');

        $this->assertSame(Sort::DEFAULT_DIRECTION, $sort->getOrderFor('foo'));
        $this->assertSame(Sort::DEFAULT_DIRECTION, $sort->getOrderFor('bar'));
    }

    public function testSortByDirectionAndProperties()
    {
        $sort = Sort::byDirection(Direction::DESC, 'foo', 'bar');

        $this->assertSame(Direction::DESC, $sort->getOrderFor('foo'));
        $this->assertSame(Direction::DESC, $sort->getOrderFor('bar'));
    }

    public function testAllowCombiningSorts()
    {
        $sort = Sort::by('foo')->and(Sort::by('bar')->descending());
        $this->assertEquals([
            new Direction(Direction::ASC, 'foo'),
            new Direction(Direction::DESC, 'bar'),
        ], $sort->getIterator()->getArrayCopy());
    }

    public function testIsSorted()
    {
        $sort = Sort::unsorted();

        $this->assertFalse($sort->isSorted());
        $this->assertTrue($sort->isUnsorted());

        $sort = Sort::by('foo');

        $this->assertTrue($sort->isSorted());
        $this->assertFalse($sort->isUnsorted());
    }

    public function testChangingDirection()
    {
        $initialSort = Sort::by('foo');

        $this->assertNotSame($initialSort, $initialSort->descending());
        $this->assertNotSame($initialSort, $initialSort->ascending());

        $this->assertSame(Direction::DESC, $initialSort->descending()->getOrderFor('foo'));
        $this->assertSame(Direction::ASC, $initialSort->ascending()->getOrderFor('foo'));
    }
}
