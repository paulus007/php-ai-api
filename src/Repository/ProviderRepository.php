<?php

namespace App\Repository;

use App\Entity\Provider;
use App\Representation\Page;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ProviderRepository extends AbstractRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function findOne(int $id): ?Provider
    {
        return $this->entityManager->getRepository(Provider::class)->find($id);
    }

    public function findPage(int $offset, int $limit, string $search): Page
    {
        $offset = max(self::DEFAULT_OFFSET, $offset);
        $limit = max(self::DEFAULT_LIMIT, $limit);

        $qbRecords = $this->entityManager->getRepository(Provider::class)
            ->createQueryBuilder('p');
        $qbCount = $this->entityManager->getRepository(Provider::class)
            ->createQueryBuilder('p')
            ->select('count(p.id)');

        if (trim($search) !== '') {
           $qbRecords->andWhere('p.name LIKE :search')
               ->orWhere('p.description LIKE :search')
               ->setParameter('search', '%' . $search . '%');
           $qbCount->andWhere('p.name LIKE :search')
               ->orWhere('p.description LIKE :search')
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

    public function saveProvider(Provider $provider): Provider
    {
        $this->entityManager->persist($provider);
        $this->entityManager->flush();

        return $provider;
    }

    public function deleteProvider(Provider $provider): Provider
    {
        $this->entityManager->remove($provider);
        $this->entityManager->flush();

        return $provider;
    }
}
