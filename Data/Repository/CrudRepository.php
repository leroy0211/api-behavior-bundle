<?php

declare(strict_types=1);

namespace Flexsounds\Bundle\ApiBehavior\Data\Repository;

trait CrudRepository
{
    /**
     * Finds an entity by its identifier.
     *
     * @param mixed $id
     *
     * @return object|null the entity instance or NULL if the entity can not be found
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * Determine if an entity exists by its identifier.
     *
     * @param mixed $id
     *
     * @return bool
     */
    public function existsById($id): bool
    {
        return (bool) $this->find($id);
    }

    /**
     * Save an entity.
     *
     * @param object $entity
     */
    public function save(object $entity): void
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush($entity);
    }

    /**
     * Save a list of entities.
     *
     * @param iterable $entities
     */
    public function saveAll(iterable $entities): void
    {
        $em = $this->getEntityManager();
        foreach ($entities as $entity) {
            $em->persist($entity);
        }
        $em->flush($entities);
    }

    /**
     * Delete an entity by its identifier.
     *
     * @param mixed $id
     */
    public function deleteById($id): void
    {
        if (null === $id) {
            throw new \InvalidArgumentException('Can not delete "null" entity');
        }

        $em = $this->getEntityManager();

        if ($entity = $this->find($id)) {
            $em->remove($entity);
            $em->flush();
        }
    }
}
