<?php

declare(strict_types=1);

namespace BaxMusic\Bundle\ApiToolkit\Data\Repository;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use LogicException;

class CrudRepository extends EntityRepository implements RepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function __construct(ManagerRegistry $registry, $entityClass)
    {
        $manager = $registry->getManagerForClass($entityClass);

        if (null === $manager) {
            throw new LogicException(sprintf(
                'Could not find the entity manager for class "%s". Check your Doctrine configuration to make sure it is configured to load this entity’s metadata.',
                $entityClass
            ));
        }

        parent::__construct($manager, $manager->getClassMetadata($entityClass));
    }

    public function save(object $entity)
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        $em->flush($entity);
    }

    public function saveAll(iterable $entities)
    {
        $em = $this->getEntityManager();

        foreach ($entities as $entity) {
            $em->persist($entity);
        }

        $em->flush($entities);
    }

    public function findById($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function existsById($id, $lockMode = null, $lockVersion = null): bool
    {
        return !!parent::find($id, $lockMode, $lockVersion);
    }

    public function deleteById($id)
    {
        if (null === $id) {
            throw new \InvalidArgumentException('Can not delete "null" entity');
        }

        $em = $this->getEntityManager();

        $em->remove($entity = $this->findById($id));
        $em->flush($entity);
    }





}
