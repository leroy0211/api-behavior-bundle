<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Tests\EventListener\Fixtures;

use Symfony\Component\Serializer\Annotation\Groups;

class FooModel
{
    /**
     * @Groups({"groupA"})
     */
    private $foo = 'lorem';
    private $bar = 'ipsum';

    /**
     * @return string
     */
    public function getFoo(): string
    {
        return $this->foo;
    }

    /**
     * @return string
     */
    public function getBar(): string
    {
        return $this->bar;
    }
}
