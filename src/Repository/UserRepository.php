<?php

namespace App\Repository;


use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class UserRepository extends ServiceEntityRepository implements AbstractRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, User::class);
    }

    public function saveItem(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    public function deleteItem(User $user): User
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();

        return $user;
    }
}
