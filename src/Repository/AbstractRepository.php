<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

interface AbstractRepository
{
    public const int DEFAULT_OFFSET = 0;
    public const int DEFAULT_LIMIT = 5;
}
