<?php

namespace App\Repository;

use App\Entity\Provider;
use App\Representation\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Provider>
 *
 * @method Provider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provider[]    findAll()
 * @method Provider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ProviderRepository extends ServiceEntityRepository implements AbstractRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, Provider::class);
    }

    public function findPage(int $offset, int $limit, string $search): Page
    {
        $offset = max(self::DEFAULT_OFFSET, $offset);
        $limit = max(self::DEFAULT_LIMIT, $limit);

        $qbRecords = $this->getEntityManager()->getRepository(Provider::class)
            ->createQueryBuilder('p');
        $qbCount = $this->getEntityManager()->getRepository(Provider::class)
            ->createQueryBuilder('p')
            ->select('count(p.id)');

        if (trim($search) !== '') {
            $qbRecords->andWhere('p.name LIKE :search')
                ->orWhere('p.description LIKE :search')
                ->setParameter('search', '%'.$search.'%');
            $qbCount->andWhere('p.name LIKE :search')
                ->orWhere('p.description LIKE :search')
                ->setParameter('search', '%'.$search.'%');
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

    public function findOne(int $id): ?Provider
    {
        return $this->getEntityManager()->getRepository(Provider::class)->find($id);
    }

    public function saveItem(Provider $provider): Provider
    {
        $this->getEntityManager()->persist($provider);
        $this->getEntityManager()->flush();

        return $provider;
    }

    public function deleteItem(Provider $provider): Provider
    {
        $this->getEntityManager()->remove($provider);
        $this->getEntityManager()->flush();

        return $provider;
    }
}
