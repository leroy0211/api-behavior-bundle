<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\Data\Domain;

use Flexsounds\Bundle\ApiBehavior\Data\Domain\Direction;
use Flexsounds\Bundle\ApiBehavior\Data\Domain\HttpSort;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class HttpSortTest extends TestCase
{
    public function testCanDoSimpleSortRequest()
    {
        $request = new Request([
            'sort' => 'foo, bar',
        ]);

        $httpSort = new HttpSort();
        $sort = $httpSort->byRequest($request);

        $this->assertEquals([
            new Direction(Direction::ASC, 'foo'),
            new Direction(Direction::ASC, 'bar'),
        ], $sort->getIterator()->getArrayCopy());
    }

    public function testCanSortDescending()
    {
        $request = new Request([
            'sort' => 'foo, bar',
            'bar_dir' => 'DESC',
        ]);

        $httpSort = new HttpSort();
        $sort = $httpSort->byRequest($request);

        $this->assertEquals([
            new Direction(Direction::ASC, 'foo'),
            new Direction(Direction::DESC, 'bar'),
        ], $sort->getIterator()->getArrayCopy());
    }

    public function testUnsortedRequest()
    {
        $request = new Request();

        $httpSort = new HttpSort();
        $sort = $httpSort->byRequest($request);

        $this->assertTrue($sort->isUnsorted());
    }

    public function testCanOverrideParameters()
    {
        $request = new Request([
            'lorem' => 'foo, bar',
            'bar_ipsum' => 'DESC',
        ]);

        $httpSort = new HttpSort();
        $httpSort->setSortParam('lorem');
        $httpSort->setSortDirectionParam('%s_ipsum');

        $sort = $httpSort->byRequest($request);

        $this->assertEquals([
            new Direction(Direction::ASC, 'foo'),
            new Direction(Direction::DESC, 'bar'),
        ], $sort->getIterator()->getArrayCopy());
    }
}
