<?php


namespace Flexsounds\Bundle\ApiBehavior\Tests\Fixtures\Data\Repository;


use Doctrine\ORM\EntityRepository;
use Flexsounds\Bundle\ApiBehavior\Data\Repository\CrudRepository;

class TempRepository extends EntityRepository
{
    use CrudRepository;

}