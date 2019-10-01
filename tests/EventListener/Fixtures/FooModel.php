<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Tests\EventListener\Fixtures;

use Symfony\Component\Serializer\Annotation\Groups;

class FooModel
{
    /**
     * @Groups({"groupA"})
     */
    public $foo = 'lorem';
    public $bar = 'ipsum';

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
