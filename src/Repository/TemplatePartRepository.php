<?php

namespace App\Repository;

use App\Entity\TemplatePart;
use App\Representation\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TemplatePart>
 *
 * @method TemplatePart|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemplatePart|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemplatePart[]    findAll()
 * @method TemplatePart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class TemplatePartRepository extends ServiceEntityRepository implements AbstractRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, TemplatePart::class);
    }

    public function findPage(int $offset, int $limit, string $search): Page
    {
        $offset = max(self::DEFAULT_OFFSET, $offset);
        $limit = max(self::DEFAULT_LIMIT, $limit);

        $qbRecords = $this->getEntityManager()->getRepository(TemplatePart::class)
            ->createQueryBuilder('p');
        $qbCount = $this->getEntityManager()->getRepository(TemplatePart::class)
            ->createQueryBuilder('p')
            ->select('count(p.id)');

        if (trim($search) !== '') {
            $qbRecords->andWhere('p.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
            $qbCount->andWhere('p.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        $records = $qbRecords->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
        $totalRecords = $qbCount->getQuery()
            ->getSingleScalarResult();

        return new Page(
            records: $records,
            totalRecords: $totalRecords,
            offset: $offset,
            limit: $limit
        );
    }

    public function findOne(int $id): ?TemplatePart
    {
        return $this->getEntityManager()->getRepository(TemplatePart::class)->find($id);
    }

    public function saveItem(TemplatePart $templatePart): TemplatePart
    {
        $this->getEntityManager()->persist($templatePart);
        $this->getEntityManager()->flush();

        return $templatePart;
    }

    public function deleteItem(TemplatePart $templatePart): TemplatePart
    {
        $this->getEntityManager()->remove($templatePart);
        $this->getEntityManager()->flush();

        return $templatePart;
    }
}
