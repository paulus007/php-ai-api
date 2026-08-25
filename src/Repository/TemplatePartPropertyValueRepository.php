<?php

namespace App\Repository;

use App\Entity\TemplatePartPropertyValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TemplatePartPropertyValue>
 *
 * @method TemplatePartPropertyValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemplatePartPropertyValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemplatePartPropertyValue[]    findAll()
 * @method TemplatePartPropertyValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class TemplatePartPropertyValueRepository extends ServiceEntityRepository implements AbstractRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, TemplatePartPropertyValue::class);
    }
}
