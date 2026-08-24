<?php

namespace App\Repository;

use App\Entity\Template;
use App\Representation\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Template>
 *
 * @method Template|null find($id, $lockMode = null, $lockVersion = null)
 * @method Template|null findOneBy(array $criteria, array $orderBy = null)
 * @method Template[]    findAll()
 * @method Template[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class TemplateRepository extends ServiceEntityRepository implements AbstractRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, Template::class);
    }

    public function findPage(int $offset, int $limit, string $search): Page
    {
        $offset = max(self::DEFAULT_OFFSET, $offset);
        $limit = max(self::DEFAULT_LIMIT, $limit);

        $qbRecords = $this->getEntityManager()->getRepository(Template::class)
            ->createQueryBuilder('p');
        $qbCount = $this->getEntityManager()->getRepository(Template::class)
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

    public function findOne(int $id): ?Template
    {
        return $this->getEntityManager()->getRepository(Template::class)->find($id);
    }

    public function saveItem(Template $template): Template
    {
        $this->getEntityManager()->persist($template);
        $this->getEntityManager()->flush();

        return $template;
    }

    public function deleteItem(Template $template): Template
    {
        $this->getEntityManager()->remove($template);
        $this->getEntityManager()->flush();

        return $template;
    }
}
