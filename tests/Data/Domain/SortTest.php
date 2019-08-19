<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\Data\Domain;

use BaxMusic\Bundle\ApiToolkit\Data\Domain\Direction;
use BaxMusic\Bundle\ApiToolkit\Data\Domain\Sort;
use PHPUnit\Framework\TestCase;

class SortTest extends TestCase
{
    public function testAppliesDefaultForOrder()
    {
        $sort = Sort::by('foo');

        $this->assertSame(Sort::DEFAULT_DIRECTION, $sort->getIterator()->current()->getDirection());
    }

    public function testAllowCombiningSorts()
    {
        $sort = Sort::by('foo')->and(Sort::by('bar')->descending());
        $this->assertEquals([
            new Direction(Direction::ASC, 'foo'),
            new Direction(Direction::DESC, 'bar'),
        ], $sort->getIterator()->getArrayCopy());
    }
}
