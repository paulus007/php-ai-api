<?php

namespace App\Repository;

use App\Entity\TemplatePartProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TemplatePartProperty>
 *
 * @method TemplatePartProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemplatePartProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemplatePartProperty[]    findAll()
 * @method TemplatePartProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class TemplatePartPropertyRepository extends ServiceEntityRepository implements AbstractRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, TemplatePartProperty::class);
    }
}
