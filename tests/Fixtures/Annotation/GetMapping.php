<?php


namespace Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\Annotation;


use Flexsounds\Bundle\ApiBehavior\Annotation\RequestMapping;

class GetMapping extends RequestMapping
{
    public function getMethod(): ?string
    {
        return 'GET';
    }
}